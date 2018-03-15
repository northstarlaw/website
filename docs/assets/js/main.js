(function () {
  'use strict';
  var d = document;
  d.documentElement.className =
    d.documentElement.className.replace('no-js', 'js');

  var _bodyHome = _('.header-transparent');
  var _header = _('.header');
  var _hero = _('.hero')
  var _tabs = _('.tabs');
  var _mobileMenuOpenButton = _('.js-mobile-menu-button');
  var _mobileMenuCloseButton = _('.js-mobile-menu-close');
  var _dropdowns = _('.js-dropdown');

  function findAncestor (el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
  }

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

  if (_bodyHome) {
    window.addEventListener('scroll', function() {
      _bodyHome.toggleClass('header-transparent', _hero && window.scrollY < (_hero[0].offsetHeight - _header[0].offsetHeight));
    })
  }

  if (_dropdowns) {
    _dropdowns.forEach(function (mod) {
      var method = mod.dataset.method || 'click';
      var trigger = _(mod).find('[data-trigger]')[0] || mod;

      var windowClickHandler = function (e) {
        if (e.target === trigger) return;
        if(!findAncestor(e.target, 'dropdown') && _('[aria-expanded="true"]')) {
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
            if(_(mod)[0].getAttribute('aria-expanded') === 'false') {
              _(mod)[0].setAttribute('aria-expanded', 'true')
              addWindowClick();
            } else {
              _(mod)[0].setAttribute('aria-expanded', 'false')
              removeWindowClick();
            }
          });
      }

      // _links[0].addEventListener('focus', function(e) {
      //   _(mod).addClass('dropdown--show');
      // });

      // _links[_links.length - 1].addEventListener('blur', function(e) {
      //   _(mod).removeClass('dropdown--show');
      // });

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
    var _links = _(tabs).find('.tabs__link[id]');
    var _content = _(tabs).find('.tabs__item');
    var _banner = _('.banner')[0];

    var tabEvents = {
      showActiveTab: function (args) {
        var id = args.id.replace(/^#/, '');
        var _activeTab = _tabs.find('[href="#' + id + '"]');
        _activeTab.attr('aria-selected', true);
        _activeTab.attr('title', 'Active tab');
        _('#' + id).attr('aria-hidden', 'false');

        _activeTab.addClass(tabShowClass);
        _tabs.find('#' + id).removeClass(tabsHideClass);

        if(_banner && args.img && args.text) {
          _banner.style.backgroundImage = "url('" + args.img + "')";
        }
      },
      resetTabs: function (body, index) {
        var _link = _('[href="#' + body.id + '"]');
        _(body).attr('aria-hidden', 'true');

        _link.attr('aria-selected', false);
        _link.attr('title', '');

        _(body).addClass(tabsHideClass);
        _link.removeClass(tabShowClass);

        if(index === _content.length - 1 && initialCall) {
          tabEvents.setInitialTab();
        }
      },
      clickHandler: function (e) {
        e.preventDefault();

        if(e.target.dataset.primaryTrigger) {
          document.getElementById(e.target.dataset.primaryTrigger).click();
          return;
        }

        if(e.target.getAttribute('aria-selected') === 'false') {
          window.location.hash = e.target.hash;

          [].forEach.call(_content, tabEvents.resetTabs);

          tabEvents.showActiveTab({
            id: e.target.hash,
            img: e.target.dataset.img || null,
            text: e.target.dataset.text || null
          });
        }
      },
      setInitialTab: function () {
        var link = _(tabs).find('[href="' + window.location.hash + '"]');
        var initialTab = link.length
          ? { id: window.location.hash, img: link[0].dataset.img, text: link[0].dataset.text }
          : { id: _content[0].id, img: _links[0].dataset.img, text: _links[0].dataset.text };

        tabEvents.showActiveTab(initialTab);

        setTimeout(function() {
          window.scrollTo(0, 0);
        }, 0);

        initialCall = false;
      },
      bindClickEvent: function (link) {
        link.addEventListener('click', tabEvents.clickHandler);
      },
      preloadImages: function () {
        var element = document.createElement('div');
        element.className = 'sr-only';
        document.body.append(element);

        for (var i = 0; i < _links.length; i++) {
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

})();
