function CleanDomain( domain ){
	var url = domain;

	if ( url.substring( 0, 7 ) == "http://" ){
		url = url.substring( 7 );
	}
	if ( url.substring( 0, 8 ) == "https://" ){
		url = url.substring(8);
	}
	if ( url.substring( 0, 4 ) == "www." ){
		url = url.substring( 4 );
	}

	return url;
}

jQuery( '#csr-generator' ).submit( function( e ) {
	e.preventDefault();

	jQuery( '#reply' ).html( '<strong>Please wait...</strong>' );

	jQuery.post(
		'api.php',
		{
			domain       : CleanDomain( jQuery( '#csr-generator #domain' ).val() ),
			organization : jQuery( '#csr-generator #organization' ).val(),
			department   : jQuery( '#csr-generator #department' ).val(),
			city         : jQuery( '#csr-generator #city' ).val(),
			state        : jQuery( '#csr-generator #state' ).val(),
			email        : jQuery( '#csr-generator #email' ).val(),
			country      : jQuery( '#csr-generator #country' ).val(),
			func         : 'generate_csr'
		},
		function( data ) {
			if ( ! data ) {
				jQuery( '#reply' ).html( '<strong>Fail</strong><p>Wrong Data!</p>' );
			} else {
				var body_string;

				body_string  = '<p><strong>Private Key:</strong><br/>';
				body_string += '<pre>' + data.private_key + '</pre></p>';
				body_string += '<p><strong>CSR:</strong><br/>';
				body_string += '<pre>' + data.csr + '</pre></p>';

				jQuery( '#reply' ).html( body_string );
			}
		}
	);
});

jQuery( '#csr-decoder' ).submit( function( e ) {
	e.preventDefault();

	jQuery( '#reply' ).html( '<strong>Please wait...</strong>' );

	jQuery.post(
		'api.php',
		{
			csr  : jQuery( '#csr-decoder #csr' ).val(),
			func : 'decoce_csr'
		},
		function( data ) {
			if ( ! data ) {
				jQuery( '#reply' ).html( '<strong>Fail</strong><p>Wrong Data!</p>' );
			} else {
				var body_string;

				body_string  = '<p><strong>Data:</strong> ' + data.CN + '<br/>';
				body_string += '<p><strong>Organization:</strong> ' + data.O + '<br/>';
				body_string += '<p><strong>Department:</strong> ' + data.OU + '<br/>';
				body_string += '<p><strong>City:</strong> ' + data.L + '<br/>';
				body_string += '<p><strong>State:</strong> ' + data.ST + '<br/>';
				body_string += '<p><strong>Email:</strong> ' + data.emailAddress + '<br/>';
				body_string += '<p><strong>Country:</strong> ' + data.C + '<br/>';

				jQuery( '#reply' ).html( body_string );
			}
		}
	);
});

jQuery( '#certificate-decoder' ).submit( function( e ) {
	e.preventDefault();

	jQuery( '#reply' ).html( '<strong>Please wait...</strong>' );

	jQuery.post(
		'api.php',
		{
			certificate : jQuery( '#certificate-decoder #certificate' ).val(),
			func        : 'decoce_certificate'
		},
		function( data ) {
			if ( ! data ) {
				jQuery( '#reply' ).html( '<strong>Fail</strong><p>Wrong Data!</p>' );
			} else {
				var body_string,
					date_from = new Date( data.validFrom_time_t * 1000 ).toDateString(),
					date_to   = new Date( data.validTo_time_t * 1000 ).toDateString();

				body_string  = '<p><strong>Domain:</strong> ' + data.subject.CN;
				body_string += '<p><strong>Issuer:</strong> ' + data.issuer.O + ' (' + data.issuer.CN + ')';
				body_string += '<p><strong>Signature Type:</strong> ' + data.signatureTypeSN;
				body_string += '<p><strong>Valid From:</strong> ' + date_from;
				body_string += '<p><strong>Valid Until:</strong> ' + date_to;

				jQuery( '#reply' ).html( body_string );
			}
		}
	);
});

jQuery( '#certificate-key-matcher' ).submit( function( e ) {
	e.preventDefault();

	jQuery( '#reply' ).html( '<strong>Please wait...</strong>' );

	jQuery.post(
		'api.php',
		{
			certificate : jQuery( '#certificate-key-matcher #certificate' ).val(),
			private_key : jQuery( '#certificate-key-matcher #private_key' ).val(),
			func        : 'match_certificate'
		},
		function( data ) {
			if ( ! data ) {
				jQuery( '#reply' ).html( '<strong>Fail</strong><p>Wrong Data!</p>' );
			} else {
				var body_string;

				body_string  = '<p><strong>Match:</strong> ' + data.reply;

				jQuery( '#reply' ).html( body_string );
			}
		}
	);
});