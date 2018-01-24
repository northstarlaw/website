(function () {
  'use strict';
  var d = document;
  document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

  // Helper Classes
  var _ = function (node) {

      if(!node) {
        throw Error('Please specify element or node');
        return;
      }

      if(node.nodeType !== Node.ELEMENT_NODE) {
        if(d.querySelector(node)) {
          node = d.querySelector(node);
        } else {
          throw Error('No element matching that description');
        }
      }

      var hasClass = function (_class) {
        return !!node.className.match(_class);
      };

      var addClass = function (_class) {
        if (!hasClass(_class)) {
          node.className += ' ' + _class;
          node.className = node.className.trim();
        }
      };

      var removeClass = function (_class) {
        if (hasClass(_class)) {
          node.className = node.className.replace(_class, '').trim();
        }
      };

      return {
        hasClass: hasClass,
        removeClass: removeClass,
        addClass: addClass
      }
  };

  var tabs = d.querySelector('.tabs');

  if (tabs) {
    var tabsHideClass = 'tabs__item--hidden';
    var tabShowClass = 'tabs__link--active';
    var links = tabs.querySelectorAll('.tabs__link');
    var content = tabs.querySelectorAll('.tabs__item');
    var banner = d.querySelector('.banner');
    var bannerHeader = banner.querySelector('.banner__header');
    var initialCall = true;

    var tabEvents = {
      showActiveTab: function (args) {
        var id = args.id.replace(/^#/, '');
        tabs.querySelector('[href="#' + id + '"]').setAttribute('aria-selected', true);
        tabs.querySelector('[href="#' + id + '"]').setAttribute('title', 'Active tab');
        d.getElementById(id).setAttribute('aria-hidden', 'false');

        _(tabs.querySelector('[href="#' + id + '"]')).addClass(tabShowClass);
        _(tabs.querySelector('#' + id)).removeClass(tabsHideClass);

        if(banner && bannerHeader && args.img && args.text) {
          banner.style.backgroundImage = "url('" + args.img + "')";
          bannerHeader.innerText = args.text;
        }
      },
      resetTabs: function (body, index) {
        body.setAttribute('aria-hidden', 'true');
        links[index].setAttribute('aria-selected', false);
        links[index].removeAttribute('title');

        _(body).addClass(tabsHideClass);
        _(links[index]).removeClass(tabShowClass);

        if(index === content.length - 1 && initialCall) {
          tabEvents.setInitialTab();
        }
      },
      clickHandler: function (e) {
        e.preventDefault();
        window.location.hash = e.target.hash;

        [].forEach.call(content, tabEvents.resetTabs);

        tabEvents.showActiveTab({
          id: e.target.hash,
          img: e.target.dataset.img || null,
          text: e.target.dataset.text || null
        });

      },
      setInitialTab: function () {
        var link = tabs.querySelector('[href="' + window.location.hash + '"]');
        var initialTab = link
          ? { id: window.location.hash, img: link.dataset.img, text: link.dataset.text }
          : { id: content[0].id, img: links[0].dataset.img, text: links[0].dataset.text };

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

    [].forEach.call(links, tabEvents.bindClickEvent);
    [].forEach.call(content, tabEvents.resetTabs);
  }

})();
