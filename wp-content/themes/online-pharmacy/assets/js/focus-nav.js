( function( window, document ) {
  function online_pharmacy_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const online_pharmacy_nav = document.querySelector( '.sidenav' );
      if ( ! online_pharmacy_nav || ! online_pharmacy_nav.classList.contains( 'open' ) ) {
        return;
      }
      const elements = [...online_pharmacy_nav.querySelectorAll( 'input, a, button' )],
        online_pharmacy_lastEl = elements[ elements.length - 1 ],
        online_pharmacy_firstEl = elements[0],
        online_pharmacy_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;
      if ( ! shiftKey && tabKey && online_pharmacy_lastEl === online_pharmacy_activeEl ) {
        e.preventDefault();
        online_pharmacy_firstEl.focus();
      }
      if ( shiftKey && tabKey && online_pharmacy_firstEl === online_pharmacy_activeEl ) {
        e.preventDefault();
        online_pharmacy_lastEl.focus();
      }
    } );
  }
  online_pharmacy_keepFocusInMenu();
} )( window, document );