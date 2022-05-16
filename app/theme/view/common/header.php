<?php require PATH . '/theme/view/common/assets.php'; ?>
<?php if($AuthUser['account_type'] == 'admin') { } else { ?>
<?php if(get($Settings,'data.maintainence','general') == 1) { ?>

<div class="maintainence">
   <a href="<?php echo APP.'/sudosu';?>">
      <div class="maintainence-admin-button">
         <center>
            <?php echo __('Admin');?>
         </center>
      </div>
   </a>
   <div class="maintenance-message">
      <center>
         <h1>
            <?php echo __('Maintenance Message');?>
         </h1>
         <?php echo __('Maintenance Sub Message');?>
         <br /><br />
         <div class="col-md-3" style="max-width: 100%;">
            <div class="nav-social" style="width:200px;">
               <?php foreach (json_decode(get($Settings,'data','social'), true) as $key => $value) { ?>
               <?php if($value) { ?>
               <a href="<?php echo 'https://www.'.$key.'.com/'.$value;?>" target="_blank" rel="noopener" title="<?php echo $key;?>">
                  <svg class="icon">
                     <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#'.$key;?>" />
                  </svg>
               </a>
               <?php } ?>
               <?php } ?>
            </div>
         </div>
      </center>
   </div>
</div>

<?php } ?>
<?php } ?>
<?php echo ads($Ads,5,'ads-skin');?>
<nav id='menu'>
  <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
  <ul>
    <li><a>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</a></li>

    <li><a href='/'>Inicio</a></li>
    <li><a class='dropdown-arrow' href='/categories'>Categorias</a>
      <ul class='sub-menus'>
        <li><a href='http://'>EM-BREVE</a></li>
        <li><a href='http://'>EM-BREVE</a></li>
        <li><a href='http://'>EM-BREVE</a></li>
        <li><a href='http://'>EM-BREVE</a></li>
      </ul>
    </li>
    <li><a href='/trends'>Tendências</a></li>
    <li><a href='/discussions'>Tópicos</a></li>
    <li><a class='dropdown-arrow'>Pedidos</a>
      <ul class='sub-menus'>
        <li><a href='/request'>Fazer Um Pedido</a></li>
        <li><a href='/requests'>Ver Pedidos</a></li>
        
      </ul>
    </li>
    <li><a class='dropdown-arrow'>Contato</a>
      <ul class='sub-menus'>
        <li><a href='http://'>Sobre nos</a></li>
        <li><a href='http://'>DMCA</a></li>
        <li><a href='http://'>Politica de Privacidade</a></li>
        <li><a href='/chat'>Chat</a></li>
        <li><a href='http://'>Regras Do Site</a></li>
      </ul>
    </li>
  </ul>
</nav>
<div class="container">
    <div class="app">
        <div class="app-header">
            <div class="navbar navbar-expand-lg">
                <div class="menu d-md-none d-block" data-toggle="modal" data-target="#aside">
                    <svg class="icon">
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#bars';?>" />
                    </svg>
                </div>
                <img src="/public/assets/img/LOGO-180X50.png" alt="Site Logo">
                <div class="app-navbar" id="app-navbar">
 				
 					
					
                </div>
                <div class="search-btn d-md-none d-block">
                    <svg class="icon">
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#search';?>" />
                    </svg>
                </div>
                <form class="header-search input-group d-md-block d-none" method="post" action="<?php echo APP.'/search';?>" id="navbarToggler">
                    <input type="hidden" name="_ACTION" value="search">
                    <input type="hidden" name="_TOKEN" value="<?php echo $Token;?>">
                    <div class="typeahead__container app-search">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <label for="search-input" class="btn px-0 mb-0" aria-label="<?php echo __('Search');?>">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#search';?>" />
                                    </svg>
                                </label>
                                <input class="video-search form-control" name="q" type="text" id="search-input" placeholder="<?php echo __('Search');?> .." autocomplete="off">
                                <button type="button" class="btn close-btn d-md-none d-block px-0" aria-label="<?php echo __('Close');?>">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-user ml-auto align-items-center text-nowrap">
                    <?php if ($AuthUser['id']) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP.'/profile/'.$AuthUser['username'].'#collections';?>" aria-label="<?php echo __('Collections');?>">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#bookmark';?>" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle notification-btn" href="#" role="button" id="dropdown-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="<?php echo __('Notifications');?>">
                            <svg class="icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#bell';?>" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-right" aria-labelledby="dropdown-notification">
                            <div class="notifications">
                                <div class="text-center">
                                    <?php echo __('Empty Notifications');?>
                                </div>
                            </div>
                            <a href="<?php echo APP.'/notifications';?>" class="all text-center">
                                <?php echo __('All');?></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-profile dropdown-toggle pr-md-0" href="#" role="button" id="dropdown-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Profile">
                            <div>
                                <?php echo gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar avatar-sm');?>
                            </div>
                            <div class="profile-text">
                                <div class="profile-head">
                                    <?php echo __('Hello');?>,</div>
                                <div class="text-nowrap">
                                    <?php echo $AuthUser['name'];?>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-profile" aria-labelledby="Dropdown Profile">
                            <?php if($AuthUser['account_type'] == 'admin') { ?>
                            <a class="dropdown-item" href="<?php echo APP.'/sudosu';?>">
                                <?php echo __('Admin panel');?></a>
                            <div class="dropdown-divider"></div>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo APP.'/profile/'.$AuthUser['username'];?>">
                                <?php echo __('Profile');?></a>
                            <a class="dropdown-item d-flex" href="<?php echo APP.'/profile/'.$AuthUser['username'].'#collections';?>">
                                <?php echo __('Collections');?></a>
                            <a class="dropdown-item" href="<?php echo APP.'/notifications';?>">
                                <?php echo __('Notifications');?></a>
                            <a class="dropdown-item" href="<?php echo APP.'/settings';?>">
                                <?php echo __('Settings');?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo APP.'/logout';?>">
                                <?php echo __('Logout');?></a>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP.'/register';?>" aria-label="<?php echo __('Register');?>">
                            <?php echo __('Register');?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP.'/login';?>" aria-label="<?php echo __('Login');?>">
                            <?php echo __('Login');?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="app-wrapper">
 			<?php if(get($Settings,'data.slidingmenu','theme') == 1) { ?>
			<div class="hide-me">
			<?php } ?>
            <div class="app-aside nav-aside" id="aside">
				<br /><br />
                <button class="modal-close d-md-none d-block" data-dismiss="modal">
                    <svg class="icon">
                        <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
                    </svg>
                </button>
                <ul class="nav mb-3 nav-user d-md-none d-block">
                    <?php if ($AuthUser['id']) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-profile dropdown-toggle" href="#" role="button" id="dropdown-profile-mobile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-labelledby="Profile Mobile">
                            <?php echo gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar avatar-sm');?>
                            <div class="profile-text">
                                <div class="profile-head">
                                    <?php echo __('Hello');?>,</div>
                                <div class="text-nowrap">
                                    <?php echo $AuthUser['name'];?>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-profile" aria-labelledby="Dropdown Profile Mobile">
                            <?php if($AuthUser['account_type'] == 'admin') { ?>
                            <a class="dropdown-item" href="<?php echo APP.'/sudosu';?>">
                                <?php echo __('Admin panel');?></a>
                            <div class="dropdown-divider"></div>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo APP.'/profile/'.$AuthUser['username'];?>">
                                <?php echo __('Profile');?></a>
                            <a class="dropdown-item d-flex" href="<?php echo APP.'/profile/'.$AuthUser['username'].'#collections';?>">
                                <?php echo __('Collections');?></a>
                            <a class="dropdown-item" href="<?php echo APP.'/notifications';?>">
                                <?php echo __('Notifications');?></a>
                            <a class="dropdown-item" href="<?php echo APP.'/settings';?>">
                                <?php echo __('Settings');?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo APP.'/logout';?>">
                                <?php echo __('Logout');?></a>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP.'/register';?>" aria-label="<?php echo __('Register');?>">
                            <?php echo __('Register');?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP.'/login';?>" aria-label="<?php echo __('Login');?>">
                            <?php echo __('Login');?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                
                <ul class="nav">
                    <li <?php if(empty($Config['nav'])) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#house';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Home');?></a>
                    </li>
                    <li <?php if($Config['nav']=='discovery' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/discovery';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#discovery';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Discovery');?></a>
                    </li>
                    <?php if(get($Settings,'data.trends','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'trends' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/trends';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#trend';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Trends');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.movie','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'movies' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/movies';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#film';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Movies');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.anime','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'anime' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/anime';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#film';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Anime');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.serie','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'series') echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/cursos';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#tv';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Cursos');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.actors','block') == 1) { ?>
                    <li <?php if($Config['nav'] =='actors' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/actors';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#actors';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Actors');?>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.channels','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'channels') echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/tv-channels';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#tv';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('TV Channels');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.request','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'request') echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/request';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#upload';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Fazer Um Pedido');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.requests','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'requests') echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/requests';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#viewrequest';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Ver Pedidos');?></a>
                    </li>
                    <?php } ?>
                    
                    <?php if(get($Settings,'data.categories','block') == 1) { ?>
                    <li <?php if($Config['nav'] =='categories' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/categories';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#categories';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Categories');?></a>
                    </li>
                    <?php } ?>
						<?php if(get($Settings,'data.chat','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'chat' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/chat';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#chat';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Chat');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.discussions','block') == 1) { ?>
                    <li <?php if($Config['nav'] =='discussions' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/discussions';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#discussion';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Discussions');?></a>
                    </li>
                    <?php } ?>
                    <?php if(get($Settings,'data.collections','block') == 1) { ?>
                    <li <?php if($Config['nav'] == 'collections' ) echo 'class="active"' ;?>>
                        <a href="<?php echo APP.'/collections';?>">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#collections';?>" />
                            </svg>
                            <?php } ?>
                            <?php echo __('Collections');?></a>
                    </li>
                    <?php } ?>                    
					<?php if(get($Settings,'data.showpages','theme') == 1) { ?>
               		 		<br />
						<li class="nav-item nav-header mt-0 pb-2"><?php echo __('Pages');?></li>
    						<?php 
            					$Pages = $this->db->from('pages')->where('status',1)->all();
            					foreach ($Pages as $Page) { 
            				?>
    					<li class="nav-item">
        					<a class="nav-link" href="<?php echo APP.'/page/'.$Page['self'];?>">
                            	<?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
                            	<svg class="nav-icon">
                                	<use xlink:href="<?php echo ASSETS.'/img/sprite.svg#chevron-right';?>" />
                            	</svg>
        						<?php } ?>
            					<?php echo $Page['name'];?>
                        	</a>
    					</li>
    						<?php } ?>
					<?php } ?>
 
                    <?php if(get($Settings,'data.trends','block') == 1) { ?>
                    <li class="nav-header"><?php echo __('Top Trends');?></li>
                    <?php 

                    $Trends = $this->db->from(null,'
                        SELECT 
                        posts.id, 
                        posts.title, 
                        posts.hit, 
                        posts.self, 
                        posts.type 
                        FROM `posts` 
                        WHERE posts.status = "1"
                        ORDER BY posts.hit DESC
                        LIMIT 0,10')
                        ->all();
                    foreach ($Trends as $Trend) { 
                    ?>
                    <li>
                        <a href="<?php echo post($Trend['id'],$Trend['self'],$Trend['type']);?>" style="align-items: flex-start;font-size: 0.785rem;display: flex;flex-direction: column;font-weight: 500;">
                            <div><?php echo $Trend['title'];?></div>
                            <div style="display: flex;align-items: center;font-size: 0.75rem;font-weight: normal;color: #9999a5;">
                                <div><?php echo $Trend['hit'].' '.__('views');?></div>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                    <?php } ?>
 					<?php if(get($Settings,'data.rssfeed','theme') == 1) { ?>              
                	<li class="nav-header">
                        <?php echo __('RSS Feeds');?>
                    </li>
                    <?php } ?>
 					<?php if(get($Settings,'data.moviefeed','theme') == 1) { ?> 
                    <li>
                        <a href="<?php echo APP.'/feeds/movies.php';?>" target="_blank">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
							<svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#rss';?>" />
                            </svg>
                        	<?php } ?>
							<?php echo __('Movies');?>
                    	</a>
                    </li>
                    <?php } ?>
 					<?php if(get($Settings,'data.showfeed','theme') == 1) { ?> 
                    <li>
                        <a href="<?php echo APP.'/feeds/cursos.php';?>" target="_blank">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
							<svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#rss';?>" />
                            </svg>
				<?php } ?>
							<?php echo __('TV Shows');?>
                    	</a>
                    </li>
                    <?php } ?>
 					<?php if(get($Settings,'data.episodefeed','theme') == 1) { ?> 
                    <li>
                        <a href="<?php echo APP.'/feeds/aulas.php';?>" target="_blank">
                            <?php if(get($Settings,'data.menuicon','theme') == 1) { ?>
							<svg class="nav-icon">
                                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#rss';?>" />
                            </svg>
			<?php } ?>
							<?php echo __('Episodes');?>
                    	</a>
                    </li>
					<?php } ?>
                </ul>
            </div>
            
 			<?php if(get($Settings,'data.slidingmenu','theme') == 1) { ?>
        	</div>
			<?php } ?>

            <div class="app-container flex-fill">
                
                <div class="container">
