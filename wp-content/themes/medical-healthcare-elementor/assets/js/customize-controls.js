(function (api) {
  // Extends our custom "medical-healthcare-elementor" section.
  api.sectionConstructor["medical-healthcare-elementor"] = api.Section.extend({
    // No events for this type of section.
    attachEvents: function () {},

    // Always make the section active.
    isContextuallyActive: function () {
      return true;
    },
  });
})(wp.customize);
