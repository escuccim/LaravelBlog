@extends('layouts.app') 

@section('content')
<div class="content">
	<!--  <div class="row">
		<div class="col-md-12">
			<h2>Eric Scuccimarra</h2>
			<hr>
		</div>
	</div>  -->
	
	<div class="row">
		<div class="col-md-12">
			<h4>Professional Experience</h4>

			<div class="panel-group" id="experience">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse1">Lumentus - Consultant</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>4/2010 - 7/2013</strong>
							
							<p>Lumentus is a PR firm based in NY, NY. I was brought on to develop an interactive dashboard which
							would allow the user to design, plan and monitor traditional PR campaigns while adding in paid media 
							elements. 
							
							<p>When setting up the campaign criteria were set including target demographics and reach goals. The 
							results of the campaign were calculated by combining data provided by media clipping services with ratings
							data. The current status of the campaign was displayed on an interactive dashboard which provided a 
							high level overview with the ability to drill-down on data. The dashboard was written in HTML, Javascript 
							and included Flash elements. The front-end was supplied with data from the back-end using JSON. 
							
							<p>I ran the project and my responsibilities included:
							<ul>
								<li>Working with Lumentus to determine the business requirements and then creating technical specifications
								accordingly.
								<li>Managed the development of the software, including hiring and managing a multitude of subcontractors.
								<li>Coding in PHP (with Zend Framework), Perl, Javascript and MySQL. Tested, debugged and integrated code
								written by other developers.
								<li>Designed and maintained the database.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse2">Borg Productions</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Principal - 10/1998 - 1/2016</strong>
							
							<p>This was my own web development company, which I ran and did most of the work for. Some notable projects include:
							
							<ul>
								<li><a href="http://http://www.abbott.com/">Abbot Labs</a> - coded an system for employees to participate
								in a health challenge and monitoring program. The system was written in PHP.
								<li><a href="http://www.prudential.com">Prudential</a> - was brought in as a subcontractor to create
								HTML templates which would be used by in-house developers.
								<li>MUSE Awards for <a href="http://aam-us.org/home">American Alliance of Museums</a> - I coded the system
								used for making and ranking entries. The system was written in ColdFusion with an MS SQL Server database.
								<li>Minneapolis Institute of Art - created a database and the code for an interactive exhibit called
								<a href="http://www.artsmia.org/larsen/">Larsen - a living archive</a>. The exhibit was written in ColdFusion.
								<li>Stylewiz.com - I created a CMS system for a style and home decor website.
								<li><a href="http://www.yai.org">YAI.org</a> - wrote e-commerce functionality for a non-profit site
								and integrated it with their existing site.
								<li><a href="http://www.pace.edu">Pace University</a> - developed system to allow students, administrators
								and teachers to access online course information. The system was written in ColdFusion. I also converted
								old functionality in ASP and Perl to ColdFusion.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse3">Media Commerce Systems</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Vice President of Engineering - 5/2008 - 1/2010</strong>
							
							<p>Media Commerce Systems (MCS) was a company focused on delivering web-based applications to streamline the
							media buying process. The software was written in ColdFusion and Javascript, and ran on Linux
							servers running MySQL databases.
							
							<p>My responsibilities included:
						
							<ul>
								<li>Managed the day to day operations of the development of the software.
								<li>Hired and managed the technical staff. The development was managed using the Scrum methodology.
								<li>Wrote requirements documents, technical specifications and test plans for products.
								<li>Coded in ColdFusion, Javascript, Ext, and SQL.
								<li>Worked on technical integration with vendor and customer systems.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse11">Raw Life Food Coop</a>
						</h4>
					</div>
					<div id="collapse11" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Treasurer - 1/2010 - 12/2012</strong>
							
							<p>The Raw Life Food Coop was a members-only nonprofit food cooperative based in Peekskill, NY. It's mission was
							to make organic and natural food available to members at reasonable prices. 
							
							<p>When I joined the coop was run on the honor system. Members could go in to the store at any time of 
							the day or night, take what food they wanted, and leave money for it. All of the accounting was done with
							paper and pencil, and the checkout process consisted of the members adding up their food on a calculator
							and writing down the total.
							
							<p>While I was the treasurer I introduced a computerized POS system with a barcode scanner and moved
							the accounting to Quickbooks. This combination allowed sales and inventory to be tracked.
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse4">Softwave Media Exchange (SWMX)</a>
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Vice President of Platform Development - 2/2006 - 5/2008</strong>
							
							<p>SWMX was a technology company delivering a real-time online way to buy and sell broadcast advertising
							time. The initial application launched by SWMX was RemnantRadio which provided radio stations with a means
							to sell unsold inventory at the last minute, and advertisers with a means to buy said inventory at a discount.
							
							<p>The systems were written in ColdFusion and Javascript, and ran on Linux servers with MySQL databases.
							
							<p>My responsibilities included:
							<ul>
								<li>Architected and programmed the original version of Remnant Radio.
								<li>Architected and designed the software and databases based on business requirements.
								<li>Hired and managed developers and DBAs.
								<li>Oversaw the devlopment of the software using Agile methodologies. The development staff at its largest 
								consisted of about 40 people.
								<li>Coded in ColdFusion, Javascript, SQL. Tested and integrated all code.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse10">Zysys Solutions</a>
						</h4>
					</div>
					<div id="collapse10" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Head of Development - 7/2001 - 2/2006</strong>
							
							<p>Zysys Solutions was an IT consulting company based in Irvington, NY. The company developed web-based
							software to streamline business processes, and also provided technical support for a number of clients.
							
							<p>My responsibilities included:
							<ul>
								<li>Aiding clients in figuring out ways they could automated their business processes to make them more
								efficient. Then created web-based software to do so.
								<li>Acted as main technical contact for most clients.
								<li>Coded in ColdFusion, Javascript, PHP, and MySQL.
								<li>Hired and supervised the technical staff.
								<li>Did technical, network and infrastructure support both in-house and for clients.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse5">RecruitSource</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Lead Developer - 7/1999 - 5/2000</strong>
							
							<p>Recruitsource was a company based in Edison, NJ which was designing software for the recruiting industry. 
							My responsibilities included:
							
							<ul>
								<li>Programmed in ColdFusion, with an MS SQL Server database.
								<li>Managed the development staff.
							</ul>
						</div>
					</div>
				</div>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse6">Evolving Systems</a>
						</h4>
					</div>
					<div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Lead Developer - 9/1998 - 10/1999</strong>
							
							<p>Evolving Systems develops web-based applications. My responsibilities included:
							
							<ul>
								<li>Programming in ColdFusion, Javascript and HTML
								<li>Creating and maintaining databases.
							</ul>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse7">More Sugar Entertainment</a>
						</h4>
					</div>
					<div id="collapse7" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Designer - 12/1998 - 8/2001</strong>
							
							<p>More Sugar is a local printed music newspaper in Westchester County, NY. I was responsible for
							creating all advertisments, page designs and layouts.
						</div>
					</div>
				</div>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse8">interActive Publishing</a>
						</h4>
					</div>
					<div id="collapse8" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Programmer - 12/1997 - 12/1999</strong>
							
							<p>interActive Publishing was a company creating interactive CD-ROMs for corporate clients. I programmed a
							number of award-winning CD-ROMs in Authorware and Director. Clients included Citibank, Honeywell and Allied Signal.
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#experience"
								href="#collapse9">Allen Memorial Art Museum</a>
						</h4>
					</div>
					<div id="collapse9" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>Lead Developer - 9/1996 - 9/1997</strong>
							
								<p>I developed an interactive CD-ROM for the Allen Memorial Art Musuem at Oberlin College to showcase its collection.
								The CD was developed in Director and included QuickTime and QuickTime VR movies.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<h4>Education</h4>

			<div class="panel-group" id="education">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#education"
								href="#education1">Marist College - Poughkeepsie, NY</a>
						</h4>
					</div>
					<div id="education1" class="panel-collapse collapse">
						<div class="panel-body">
							<p>MBA, Concentration in Finance, 5/2003
						</div>, 
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#education"
								href="#education2">Oberlin College - Oberlin, OH</a>
						</h4>
					</div>
					<div id="education2" class="panel-collapse collapse">
						<div class="panel-body">
							<p>BA in Computer Science, 5/1998
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#education"
								href="#education3">Universite de Lausanne</a>
						</h4>
					</div>
					<div id="education3" class="panel-collapse collapse">
						<div class="panel-body">
							<p>Cours de Vacance de francais, niveau C1-C2, &eacute;t&eacute; 2016
							<p>Chimie Generale, automne 2016
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
@endsection
