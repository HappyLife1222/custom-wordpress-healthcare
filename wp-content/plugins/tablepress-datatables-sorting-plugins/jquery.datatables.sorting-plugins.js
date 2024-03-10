jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	/**
	 * European dates dd.mm(.yyyy) or dd/mm(/yyyy), will be detected automatically
	 */
	'date-eu-pre': function ( date ) {
		var year = '', // year is optional
			month, day,
			character = '/';
		if ( date.indexOf('.') > 0 ) {
			character = '.'; // if found, use . as the separator, otherwise use /
		}
		date = date.replace( ' ', '' ).split( character );
		if ( date[2] ) {
			year = date[2];
		}
		month = date[1];
		if ( 1 === month.length ) {
			month = '0' + month;
		}
		day = date[0];
		if ( 1 === day.length ) {
			day = '0' + day;
		}
		return ( year + month + day ) * 1;
	},
	'date-eu-asc': function ( a, b ) {
		return a - b;
	},
	'date-eu-desc': function ( a, b ) {
		return b - a;
	},

	/**
	 * Formatted numbers, currency and percentage values, will be detected automatically
	 */
	'formatted-num-pre': function ( a ) {
		a = ( '-' === a ) ? 0 : a.replace( /[^\d\-\.]/g, "" );
		return parseFloat( a ) || 0;
	},
	'formatted-num-asc': function ( a, b ) {
		return a - b;
	},
	'formatted-num-desc': function ( a, b ) {
		return b - a;
	},

	/**
	 * Numeric Comma (numbers like 0,5), NOT detected automatically!
	 */
	'numeric-comma-pre': function ( a ) {
		a = ( '-' === a ) ? 0 : a.replace( /[^\d\-\,]/g, "" ).replace( /,/, "." );
		return parseFloat( a );
	},
	'numeric-comma-asc': function ( a, b ) {
		return a - b;
	},
	'numeric-comma-desc': function ( a, b ) {
		return b - a;
	},

	/**
	 * Numbers and text mixed in a column, text is treated as infinity
	 */
	'numbers+text-pre': function ( a ) {
		if ( ! isNaN( parseFloat( a ) ) && isFinite( a ) ) {
			return parseFloat(a);
		} else {
			return Number.MAX_VALUE;
		}
	},
	'numbers+text-asc': function ( a, b ) {
		return a - b;
	},
	'numbers+text-desc': function ( a, b ) {
		return b - a;
	},

	/* Cell content like 1, 1a, 1b, 2, 3, 3a, 3b, 3c, etc. */
	'numbers+letter-pre': function ( a ) {
		const number = parseInt( a );
		const letter = a.replace( number, '' );
		if ( '' === letter ) {
			return number;
		}
		return number + ( letter.toLowerCase().charCodeAt( 0 ) - 96 ) / 100;
	},
	'numbers+letter-asc': function ( a, b ) {
		return a - b;
	},
	'numbers+letter-desc': function ( a, b ) {
		return b - a;
	},
} );

/**
 * Type detection for currency and percentage values
 */
jQuery.fn.dataTableExt.aTypes.unshift( function ( data ) {
	if ( null !== data && data.match( /^(0[1-9]|[12][0-9]|30|31)[\.\/](0[1-9]|1[012])[\.\/](19|20|21)\d\d$/ ) ) {
		return 'date-eu';
	}
	return null;
} );

/**
 * Type detection for currency and percentage values
 */
(function(){
	var re = new RegExp( "[^\$£€%0-9\.,' -]" ); // Init the regex just once for speed
	jQuery.fn.dataTableExt.aTypes.unshift( function ( data ) {
		if ( typeof data !== 'string' || re.test( data ) ) {
			return null;
		}
		return 'formatted-num';
	} );
}());

/**
 * Type detection for formatted numbers
 */
jQuery.fn.dataTableExt.aTypes.unshift( function ( data ) {
	var deformatted = data.replace(/[^\d\-\.\/a-zA-Z]/g,'');
	if ( jQuery.isNumeric( deformatted ) || '-' === deformatted ) {
		return 'formatted-num';
	}
	return null;
} );
