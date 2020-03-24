
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
	<li><a href="#!" class="waves-effect">one</a></li>
	<li><a href="#!" class="waves-effect">two</a></li>
	<li class="divider"></li>
	<li><a href="#!" class="waves-effect">three</a></li>
</ul>
<nav class="cyan accent-4">
	<div class="row">
	  <div class="col m2 l2"> </div>
		<div class="col s10 m10 l10">
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo " style="margin-left: 20px"><i class="material-icons left hide-on-small-only">flight_takeoff</i>Reiseziel</a>
				<!-- activate side-bav in mobile view -->
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="sass.html">Sass</a></li>
					<li><a href="components.html" class="waves-effect">Components</a></li>
					<!-- Dropdown Trigger -->
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
				<!-- navbar for mobile -->
				<ul class="side-nav" id="mobile-demo">

						<li><div class="user-view">
							<div class="background">
								<img src="/assets/images/desert.jpg" height="176" width="300">
							</div>
								<a href="#!user"><img class="circle" src="/assets/images/koala.jpg"></a>
								<a href="#!name"><span class="white-text name">John Doe</span></a>
								<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
							</div></li>

				       <li><a href="#!" class="waves-effect">First Sidebar Link</a></li>
				       <li><a href="#!" class="waves-effect">Second Sidebar Link</a></li>
				       <li class="no-padding">
				         <ul class="collapsible collapsible-accordion">
				           <li>
				             <a class="collapsible-header">Dropdown </a>
				             <div class="collapsible-body">
				               <ul>
				                 <li><a href="#!" class="waves-effect">First</a></li>
				                 <li><a href="#!" class="waves-effect">Second</a></li>
				                 <li><a href="#!" class="waves-effect">Third</a></li>
				                 <li><a href="#!" class="waves-effect">Fourth</a></li>
				               </ul>
				             </div>
				           </li>
				         </ul>
				       </li>

							 <li class="no-padding">
				         <ul class="collapsible collapsible-accordion">
				           <li>
				             <a class="collapsible-header">Dropdown 1 </a>
				             <div class="collapsible-body">
				               <ul>
				                 <li><a href="#!" class="waves-effect">First</a></li>
				                 <li><a href="#!" class="waves-effect">Second</a></li>
				                 <li><a href="#!" class="waves-effect">Third</a></li>
				                 <li><a href="#!" class="waves-effect">Fourth</a></li>
				               </ul>
				             </div>
				           </li>
				         </ul>
				       </li>

					<div class="divider"></div>
					<li><a href="sass.html" class="waves-effect">Sass</a></li>
					<li><a href="components.html" class="waves-effect">Components</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="row">
	<div class="col m2 l2">

		<ul id="slide-out1" class="side-nav fixed" style="width:250px">
			<li><div class="user-view">
				<div class="background">
					<img src="/assets/images/desert.jpg" height="176" width="300">
				</div>
					<a href="#!user"><img class="circle" src="/assets/images/koala.jpg"></a>
					<a href="#!name"><span class="white-text name">John Doe</span></a>
					<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
				</div></li>

	       <li><a href="#!">First Sidebar Link</a></li>
	       <li><a href="#!">Second Sidebar Link</a></li>
	       <li class="no-padding">
	         <ul class="collapsible collapsible-accordion">
	           <li>
	             <a class="collapsible-header">Dropdown </a>
	             <div class="collapsible-body">
	               <ul>
	                 <li><a href="#!">First</a></li>
	                 <li><a href="#!">Second</a></li>
	                 <li><a href="#!">Third</a></li>
	                 <li><a href="#!">Fourth</a></li>
	               </ul>
	             </div>
	           </li>
	         </ul>
	       </li>

				 <li class="no-padding">
	         <ul class="collapsible collapsible-accordion">
	           <li>
	             <a class="collapsible-header">Dropdown 1 </a>
	             <div class="collapsible-body">
	               <ul>
	                 <li><a href="#!">First</a></li>
	                 <li><a href="#!">Second</a></li>
	                 <li><a href="#!">Third</a></li>
	                 <li><a href="#!">Fourth</a></li>
	               </ul>
	             </div>
	           </li>
	         </ul>
	       </li>
	     </ul>

	</div>
	<div class="col s12 m10 l10">
		@yield('content')
	</div>
</div>
