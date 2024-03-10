    jQuery(document).ready(function($) {
      jQuery(document).on('click', '.ive-wc-remove-item', function() {
        jQuery(this).parents('tr.ive-wc-sub-row').remove();
      });
  
      jQuery(document).on('click', '.ive-wc-add-item', function() {
        var p_this = jQuery(this);
        var row_no = p_this.closest('.ive-wc-item-table').find('tr.ive-wc-sub-row').length;
        row_no = parseFloat(row_no);
        var row_html = p_this.closest('.ive-wc-item-table').find('.ive-wc-hide-tr').html().replace(/rand_no/g, row_no).replace(/ive_hide_custom_repeater_item/g, p_this.closest('.ive-wc-item-table').find('.ive-get-hidden-val').val());
        p_this.closest('.ive-wc-item-table').find('tbody').append('<tr class="ive-wc-sub-row">' + row_html + '</div>');
      });
    });  