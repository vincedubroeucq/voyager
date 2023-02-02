/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens.
 */
document.addEventListener( 'DOMContentLoaded', e => {
	// Manage menu buttons
	const toggles = document.querySelectorAll( '.menu-overlay-toggle' );
	const menuOverlay = document.querySelector( '.main-menu-overlay' );
	if ( toggles && menuOverlay ) {
		toggles.forEach( toggle => {
			toggle.addEventListener( 'click', e => {
				menuOverlay.classList.toggle( 'open' );
				toggles.forEach( toggle => {
					toggle.setAttribute( 'aria-expanded', menuOverlay.classList.contains( 'open' ) );
				});
			});
		});
	}

	// Toggle 'focus' class on <li> elements.
	const links = menuOverlay.querySelectorAll( 'a' );
	const toggleFocus = e => {
		const parent = e.target.parentNode;
		if ( parent.classList.contains( 'menu-item' ) ) {
			parent.classList.toggle( 'focus' );
		}
	};
	links.forEach( link => {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'touchstart', toggleFocus, true );
		link.addEventListener( 'blur', e => {
			links.forEach( link => {
				link.parentNode.classList.remove( 'focus' );
			} )
		}, true );
	});
});
