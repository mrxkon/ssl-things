<?php

header( 'Content-Type: application/json' );

if ( isset( $_POST['func'] ) ) {
	$func = $_POST['func'];

	if ( 'generate_csr' === $func ) {
		$csrdata = array(
			'commonName'             => '',
			'organizationName'       => '',
			'organizationalUnitName' => '',
			'localityName'           => '',
			'stateOrProvinceName'    => '',
			'emailAddress'           => '',
			'countryName'            => '',
		);

		$openssl_config = array(
			'digest_alg'       => 'sha256',
			'private_key_bits' => 2048,
			'private_key_type' => OPENSSL_KEYTYPE_RSA,
		);

		if ( isset( $_POST['domain'] ) ) {
			$csrdata['commonName'] = $_POST['domain'];
		}
		if ( isset( $_POST['organization'] ) ) {
			$csrdata['organizationName'] = $_POST['organization'];
		}
		if ( isset( $_POST['department'] ) ) {
			$csrdata['organizationalUnitName'] = $_POST['department'];
		}
		if ( isset( $_POST['city'] ) ) {
			$csrdata['localityName'] = $_POST['city'];
		}
		if ( isset( $_POST['state'] ) ) {
			$csrdata['stateOrProvinceName'] = $_POST['state'];
		}
		if ( isset( $_POST['email'] ) ) {
			$csrdata['emailAddress'] = $_POST['email'];
		}
		if ( isset( $_POST['country'] ) ) {
			$csrdata['countryName'] = $_POST['country'];
		}

		if ( ! in_array( '', $csrdata, true ) ) {
			$privkey = openssl_pkey_new( $openssl_config );

			openssl_pkey_export( $privkey, $privkey_out );

			$csr = openssl_csr_new( $csrdata, $privkey, $openssl_config );

			openssl_csr_export( $csr, $csr_out );

			$data = array(
				'private_key' => $privkey_out,
				'csr'         => $csr_out,
			);
		}
	} elseif ( 'decoce_csr' === $func ) {
		if ( ! empty( $_POST['csr'] ) ) {
			$data = openssl_csr_get_subject( $_POST['csr'] );
		}
	} elseif ( 'decoce_certificate' === $func ) {
		if ( ! empty( $_POST['certificate'] ) ) {
			$data = openssl_x509_parse( $_POST['certificate'] );
		}
	} elseif ( 'match_certificate' === $func ) {
		if ( isset( $_POST['certificate'] ) && isset( $_POST['private_key'] ) ) {
			$cert = $_POST['certificate'];
			$pkey = $_POST['private_key'];

			if ( openssl_x509_check_private_key( $cert, $pkey ) ) {
				$data = array( 'reply' => 'True' );
			} else {
				$data = array( 'reply' => 'False' );
			}
		}
	}
}

echo json_encode( $data );
