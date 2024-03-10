( function( api ) {

	// Extends our custom "medical-clinic-lite" section.
	api.sectionConstructor['medical-clinic-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );