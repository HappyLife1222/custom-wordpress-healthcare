( function( api ) {

	// Extends our custom "online-pharmacy" section.
	api.sectionConstructor['online-pharmacy'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );