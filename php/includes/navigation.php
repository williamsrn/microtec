<?php ?>
<!--                        NAVBAR                      -->
<!-- ================================================== -->


<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="">
            <div id="logoContainer">
                <a class="logo" href="index.php"><img src="img/logo_v6_lg.png" alt=""/></a><a class="secret" href="javascript: screensize();">LLC</a>
            </div>
            <nav id="navBut">                
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
            </nav>          
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Solutions <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="prospect_tracker.php">Prospect Tracker</a></li>
                          <li><a href="#">Bulk Mailer</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Employee Time Manager</a></li>
                          <li><a href="#">Team Builder</a></li>
                          <li><a href="#">Name Generator</a></li>
                          <li class="divider"></li>
                          <!--<li class="dropdown-header">Quoting and Invoicing</li>-->
                          <li><a href="#">QuickQuote!</a></li>
                          <li><a href="#">Pocket Invoice Manager</a></li>
                        </ul>
                    </li>
                    <li class="divider"><?php if($page != '2')signInDisplay('poo'); ?></li>
                    <li>
                </ul>
            </div>
        </div>
    </div> 
</nav>
      