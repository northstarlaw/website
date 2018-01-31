(function () {
  'use strict';
  var d = document;
  d.documentElement.className =
    d.documentElement.className.replace('no-js', 'js');

  var _tabs = _('.tabs');
  var _mobileMenu = _('.inner-wrap')[0];

  if (_mobileMenu) {
    _mobileMenu.addEventListener('click', function (e) {
      if(_(e.target).hasClass('navbar-toggler')) {
        _(this).toggleClass('inner-wrap--show-menu');
      }
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
    var _bannerHeader = _(_banner).find('.banner__header')[0];

    var tabEvents = {
      showActiveTab: function (args) {
        var id = args.id.replace(/^#/, '');
        _(tabs).find('[href="#' + id + '"]').attr('aria-selected', true);
        _(tabs).find('[href="#' + id + '"]').attr('title', 'Active tab');
        _('#' + id).attr('aria-hidden', 'false');

        _(tabs).find('[href="#' + id + '"]').addClass(tabShowClass);
        _(tabs).find('#' + id).removeClass(tabsHideClass);

        if(_banner && _bannerHeader && args.img && args.text) {
          _banner.style.backgroundImage = "url('" + args.img + "')";
          _bannerHeader.innerText = args.text;
        }
      },
      resetTabs: function (body, index) {
        _(body).attr('aria-hidden', 'true');
        _(_links[index]).attr('aria-selected', false);
        _(_links[index]).attr('title', '');

        _(body).addClass(tabsHideClass);
        _(_links[index]).removeClass(tabShowClass);

        if(index === _content.length - 1 && initialCall) {
          tabEvents.setInitialTab();
        }
      },
      clickHandler: function (e) {
        e.preventDefault();
        window.location.hash = e.target.hash;

        [].forEach.call(_content, tabEvents.resetTabs);

        tabEvents.showActiveTab({
          id: e.target.hash,
          img: e.target.dataset.img || null,
          text: e.target.dataset.text || null
        });

      },
      setInitialTab: function () {
        var link = _(tabs).find('[href="' + window.location.hash + '"]');
        var initialTab = link
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
      }
    };

    _links.forEach(tabEvents.bindClickEvent);
    _content.forEach(tabEvents.resetTabs);
  }

})();
