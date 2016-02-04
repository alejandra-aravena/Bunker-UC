
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
    
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
			</button>
         	<a class="navbar-brand" href="../../home.php" id="NombreProyecto"></a>
		</div>

        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
                <li><a href="../../home.php">Inicio</a></li>
                <li><a href="../../ingreso/logout.php">Salir</a></li>
                <li><a href="../../home.php"><img class="img-responsive navbar-left" alt="logo" src="../../img/logoCab.png"/></a></li>
			</ul>
            
            <p class="navbar-text navbar-right text-uppercase" style="color: #FFF;"><strong><?php echo $_SESSION['username'];?></strong></p>
            
        </div>
        
        
        
	</div>
</nav>