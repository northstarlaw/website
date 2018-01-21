(function () {
  var d = document;
  var tabs = d.querySelector('.tabs');

  if (tabs) {
    var tabsHideClass = 'tabs__item--hidden';
    var tabShowClass = 'tabs__link--active';
    var links = tabs.querySelectorAll('.tabs__link');
    var content = tabs.querySelectorAll('.tabs__item');
    var initialCall = true;

    var tabEvents = {
      showActiveTab: function (args) {
        id = args.id.replace(/^#/, '');
        tabs.querySelector('[href="#' + id + '"]').classList.add(tabShowClass);
        d.getElementById(id).classList.remove(tabsHideClass);
      },
      resetTabs: function (body, index) {
        body.classList.add(tabsHideClass);
        links[index].classList.remove(tabShowClass);

        if(index === content.length - 1 && initialCall) {
          tabEvents.setInitialTab();
        }
      },
      clickHandler: function (e) {
        e.preventDefault();
        [].forEach.call(content, tabEvents.resetTabs);
        tabEvents.showActiveTab({id: e.target.hash});
      },
      setInitialTab: function () {
        var windowHash = window.location.hash;
        var initialTab = content[0].id;

        if(windowHash) {
          initialTab = tabs.querySelector(windowHash)
            ? tabs.querySelector(windowHash).id
            : content[0].id;
        }

        tabEvents.showActiveTab({id: initialTab});
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
