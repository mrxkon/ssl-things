<?php require_once __DIR__ . '/countries.php'; ?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>ssl things...</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>

	<body>
	<div class="container mt-5">
		<div class="row">
			<!-- Tools -->
			<div class="col">
				<div class="accordion" id="tools">
					<!-- CSR Generator -->
					<div class="card">
						<div class="card-header" id="csrgeneratorHeading">
							<h2 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#csrgenerator" aria-expanded="true" aria-controls="csrgenerator">
								CSR Generator
								</button>
							</h2>
						</div>
						<div id="csrgenerator" class="collapse" aria-labelledby="csrgeneratorHeading" data-parent="#tools">
							<div class="card-body">
								<form method="post" id="csr-generator" action="">
									<div class="form-group">
										<label for="domain">Domain</label>
										<input type="text" class="form-control" id="domain" placeholder="example.com" required>
									</div>
									<div class="form-group">
										<label for="organization">Organization (in English)</label>
										<input type="text" class="form-control" id="organization" placeholder="Example Inc." required>
									</div>
									<div class="form-group">
										<label for="department">Department</label>
										<input type="text" class="form-control" id="department" placeholder="IT Dept" required>
									</div>
									<div class="form-group">
										<label for="city">City</label>
										<input type="text" class="form-control" id="city" placeholder="Athens" required>
									</div>
									<div class="form-group">
										<label for="state">State</label>
										<input type="text" class="form-control" id="state" placeholder="Attica" required>
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" class="form-control" id="email" placeholder="admin@example.com" required>
									</div>
									<div class="form-group">
										<label for="country">Country</label>
										<select class="form-control" id="country" required>
										<?php foreach ( $countries as $code => $name ) { ?>
											<option value="<?php echo $code; ?>"><?php echo $name; ?></option>
										<?php } ?>
										</select>
									</div>
									<button class="btn btn-primary" type="submit">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /CSR Generator -->

					<!-- CSR Decoder -->
					<div class="card">
						<div class="card-header" id="csrdecoderHeading">
							<h2 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#csrdecoder" aria-expanded="true" aria-controls="csrdecoder">
								CSR Decoder
								</button>
							</h2>
						</div>
						<div id="csrdecoder" class="collapse" aria-labelledby="csrdecoderHeading" data-parent="#tools">
							<div class="card-body">
								<form method="post" id="csr-decoder" action="">
									<div class="form-group">
										<label for="csr">CSR</label>
										<textarea type="text" class="form-control" id="csr" required rows="15"></textarea>
									</div>
									<button class="btn btn-primary" type="submit">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /CSR Decoder -->

					<!-- Certificate Decoder -->
					<div class="card">
						<div class="card-header" id="certdecoderHeading">
							<h2 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#certdecoder" aria-expanded="true" aria-controls="certdecoder">
								Certificate Decoder
								</button>
							</h2>
						</div>
						<div id="certdecoder" class="collapse" aria-labelledby="certdecoderHeading" data-parent="#tools">
							<div class="card-body">
								<form method="post" id="certificate-decoder" action="">
									<div class="form-group">
										<label for="certificate">Certificate</label>
										<textarea type="text" class="form-control" id="certificate" required rows="15"></textarea>
									</div>
									<button class="btn btn-primary" type="submit">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /Certificate Decoder -->

					<!-- Certificate & Key Matcher -->
					<div class="card">
						<div class="card-header" id="certkeymatchHeading">
							<h2 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#certkeymatch" aria-expanded="true" aria-controls="certkeymatch">
								Certificate & Key Matcher
								</button>
							</h2>
						</div>
						<div id="certkeymatch" class="collapse" aria-labelledby="certkeymatchHeading" data-parent="#tools">
							<div class="card-body">
								<form method="post" id="certificate-key-matcher" action="">
									<div class="form-group">
										<label for="certificate">Certificate</label>
										<textarea type="text" class="form-control" id="certificate" required rows="15"></textarea>
									</div>
									<div class="form-group">
										<label for="private_key">Private Key</label>
										<textarea type="text" class="form-control" id="private_key" required rows="15"></textarea>
									</div>
									<button class="btn btn-primary" type="submit">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /Certificate & Key Matcher -->
				</div>
			</div>
			<!-- /Tools -->

			<!-- Reply -->
			<div id="reply" class="col" style="border-left:1px solid black; padding: 10px;">
			</div>
			<!-- /Reply -->
		</div>
	</div>
		<script src="scripts.js"></script>
	</body>
</html>
