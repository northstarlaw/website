(function () {
  'use strict';
  var d = document;
  d.documentElement.className =
    d.documentElement.className.replace('no-js', 'js');

  var _header = _('.header');
  var _hero = _('.hero')
  var _tabs = _('.tabs');
  var _mobileMenuOpenButton = _('.js-mobile-menu-button');
  var _mobileMenuCloseButton = _('.js-mobile-menu-close');
  var _dropdowns = _('.js-dropdown');
  var _scrollers = _('[data-scrollTo]');
  var $cookie = jQuery('.cookie-notice');

  if (_mobileMenuOpenButton) {
    var _body = _('body');

    var toggleMenu = function () {
      _body.toggleClass('mobile-menu-show');
    }

    _mobileMenuOpenButton[0].addEventListener('click', function () {
      toggleMenu();
    });

    _mobileMenuCloseButton[0].addEventListener('click', function () {
      toggleMenu();
    });

    window.addEventListener('keydown', function (e) {
      if(e.keyCode === 27 && _('.mobile-menu-show')) {
        _('.mobile-menu-show').removeClass('mobile-menu-show');
      }
    })
  }

  if (_scrollers) {
    _scrollers.forEach(function (scroller) {
      var target = _(scroller.hash);
      scroller.addEventListener('click', function (e) {
        e.preventDefault();

        jQuery("html, body").animate({ scrollTop: (target[0].offsetTop - _header[0].clientHeight) + 'px' });
      });
    })
  }

  if (_dropdowns) {
    _dropdowns.forEach(function (mod) {
      var method = mod.dataset.method || 'click';
      var trigger = _(mod).find('[data-trigger]')[0] || mod;

      var windowClickHandler = function (e) {
        if (e.target === trigger) return;
        if(!jQuery(e.target).parents('.js-dropdown').length && _('[aria-expanded="true"]')) {
          _('[aria-expanded="true"]').forEach(function (dropdown) {
            dropdown.setAttribute('aria-expanded', 'false');
          });
        }
      }

      var addWindowClick = function () {
        window.addEventListener('mouseup', windowClickHandler, false)
      };

      var removeWindowClick = function () {
        window.removeEventListener('mouseup', windowClickHandler)
      };

      switch(method) {
        case 'hover':
          var timer;
          trigger.addEventListener('mouseover', function(e) {
            clearTimeout(timer);
            _(mod)[0].addAttribute('aria-expanded', true)
          });

          trigger.addEventListener('mouseleave', function(e) {
            timer = setTimeout(function () {
              _(mod)[0].setAttribute('aria-expanded', 'false')
            }, 500)
          });
        default:
          trigger.addEventListener(method, function(e) {
            e.preventDefault();
            if(e.currentTarget.getAttribute('aria-expanded') === 'false') {
              e.currentTarget.setAttribute('aria-expanded', 'true')
              addWindowClick();
            } else {
              console.log(e.currentTarget.getAttribute('aria-expanded') )
              e.currentTarget.setAttribute('aria-expanded', 'false')
              removeWindowClick();
            }
          });
      }

      window.addEventListener('keyup', function (e) {
        if(e.keyCode === 27 && _('[aria-expanded="true"]')) {
          _('[aria-expanded="true"]').forEach(function (dropdown) {
            dropdown.setAttribute('aria-expanded', 'false');
          });
        }
      });
    })
  }

  if (_tabs) {
    var tabs = _tabs[0];
    var tabsHideClass = 'tabs__item--hidden';
    var tabShowClass = 'tabs__link--active';
    var initialCall = true;
    var _links = _(tabs).find('.tabs__link');
    var _content = _(tabs).find('.tabs__item');
    var _banner = _('.banner')[0];

    var tabEvents = {
      showActiveTab: function (args) {
        var id = args.id.replace(/^#/, '');
        var _activeTab = _tabs.find('[href="#' + id + '"]');
        var _activeTabBody = _('#' + id);
        _activeTab.attr('aria-selected', true);
        _activeTab.attr('title', 'Active tab');
        _activeTabBody.attr('aria-hidden', 'false');

        _activeTab.addClass(tabShowClass);
        _activeTabBody.removeClass(tabsHideClass);
        _activeTabBody.removeClass(tabsHideClass + '-mobile');

        if(window.innerWidth < 768) {
          _(tabs).find('.js-mobile-tab-hook')[0].insertBefore(_activeTabBody[0].parentNode, _(tabs).find('.js-mobile-tab-hook')[0].firstChild);
        }

        if(_banner && args.img && args.text) {
          _banner.style.backgroundImage = "url('" + args.img + "')";
        }
      },
      resetTabs: function (body, index) {
        var _link = _('[href="#' + body.id + '"]');
        _(body).attr('aria-hidden', 'true');

        _link.attr('aria-selected', false);
        _link.attr('title', '');
        _link.removeClass(tabShowClass);

        _(body).addClass(tabsHideClass);

        if(index === _content.length - 1 && initialCall) {
          tabEvents.setInitialTab();
        }
      },
      clickHandler: function (e) {
        e.preventDefault();

        if(e.currentTarget.getAttribute('aria-controls')) {
          jQuery("html, body").animate({ scrollTop: '0px' });
        }

        if(e.target.dataset.primaryTrigger) {
          document.getElementById(e.target.dataset.primaryTrigger).click();
          return;
        }

        if(e.target.getAttribute('aria-selected') === 'false') {
          window.location.hash = e.target.hash;

          [].forEach.call(_content, tabEvents.resetTabs);
          _(e.target.hash).removeClass(tabsHideClass + '-mobile');
          _(e.target).removeClass('tabs__link--inactive-mobile');

          tabEvents.showActiveTab({
            id: e.target.hash,
            img: e.target.dataset.img || null,
            text: e.target.dataset.text || null
          });
        } else {
          if(window.innerWidth < 768) {
            _(e.target.hash).addClass(tabsHideClass + '-mobile');
            _('.tabs__mobile-head ' + '[data-primary-trigger="' + e.target.id + '"]').removeClass(tabShowClass)
            _(e.target).attr('aria-selected', false);
          }
        }
      },
      setInitialTab: function () {
        if(window.innerWidth >= '768' || (window.innerWidth < '768' && window.location.hash)) {
          var link = _(tabs).find('[href="' + window.location.hash + '"]');
          var initialTab = window.location.hash.length
            ? { id: window.location.hash, img: link[0].dataset.img, text: link[0].dataset.text }
            : { id: _links[0].getAttribute('aria-controls'), img: _links[0].dataset.img, text: _links[0].dataset.text };

          tabEvents.showActiveTab(initialTab);

          if (window.location.hash) {
            setTimeout(function() {
              window.scrollTo(0, 0);
            }, 100);
          }
        } else {
          _banner.style.backgroundImage = "url('" + _links[0].dataset.img + "')";
        }

        initialCall = false;
      },
      bindClickEvent: function (link) {
        link.addEventListener('click', tabEvents.clickHandler);
      },
      preloadImages: function () {
        var element = document.createElement('div');
        element.className = 'sr-only';
        document.body.appendChild(element);

        for (var i = 0; i < _('[data-img]').length; i++) {
          var image = new Image();
          image.src = _links[i].dataset.img;
          element.appendChild(image);
        }
      }
    };

    _links.forEach(tabEvents.bindClickEvent);
    _content.forEach(tabEvents.resetTabs);

    tabEvents.preloadImages();
  }

  if ($cookie) {
      var $close = $cookie.find('.js-cookie-close');

      if(document.cookie.split(';').filter(function(item) {
              return item.indexOf('cookie_notice_dismissed=') >= 0
          }).length) {
          $cookie.hide();
      }

      $close.on('click', function() {
          document.cookie = 'cookie_notice_dismissed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
          $cookie.hide();
      });
  }

})();
