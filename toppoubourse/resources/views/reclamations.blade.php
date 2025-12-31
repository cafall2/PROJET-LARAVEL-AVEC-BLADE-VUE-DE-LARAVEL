<!DOCTYPE html>
<html>
<head>
	<title>Page de réclamations</title>
	<style>
		body {
			background-color: #5cb85c;
		}
		.container {
			margin: 0 auto;
			max-width: 800px;
			padding: 20px;
			background-color: #fff;
			border-radius: 20px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
		}
		.separator {
			position: relative;
			width: 100%;
			height: 50px;
		}
		.separator:before {
			content: '';
			position: absolute;
			top: 50%;
			left: 0;
			transform: translateY(-50%);
			height: 2px;
			width: 100%;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.5);
		}
		.button {
			display: inline-block;
			padding: 10px 20px;
			background-color: #fff;
			color: #5cb85c;
			border: none;
			border-radius: 5px;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.5);
			margin-right: 10px;
		}
		.button:hover {
			background-color: #5cb85c;
			color: #fff;
			cursor: pointer;
		}
		.right {
			float: right;
			text-align: right;
			margin-top: -50px;
		}
		.right h2 {
			font-size: 36px;
			margin-bottom: 0;
		}
        .header {
  background-color: #5cb85c;
  height: 100px;
  position: relative;
}

.header h1 {
  color: #ffffff;
  font-size: 50px;
  font-weight: bold;
  margin: 0;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 20px;
}

	</style>
</head>
<body>
    <div class="header">
        <h1>ToppouBourse</h1>
      </div>
	<div class="container">

		<h1>Page de réclamations</h1>
		<div class="separator"></div>
		<p>Faites votre choix:</p>
		<a href="{{ route('formulaire') }}" class="button">Faire une réclamation</a>
		<a href="{{ route('formulairesocial') }}" class="button">Faire une demande de bourse</a>
	</div>

</body>
</html>
