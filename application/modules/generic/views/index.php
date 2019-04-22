<!DOCTYPE html>
<html lang="<?= (isset($lang) && $lang == 'gr' ? 'el-GR' : 'en-GB') ?>">

    <head>
        <meta charset="UTF-8">
        <title><?= $meta_title. ' | ' ?>ΝΤΕΤΕΚΤΙΒ</title>
        <meta name="description" content="<?= $meta_description ?>">
        <meta name="keywords" content="<?= $meta_keywords ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300%7CRoboto:400,100,300,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/custom.css">
    </head>

    <body class="trd-home-template trd-homepage-one language-<?= $lang ?>">
        <!-- HEADER -->
        <header class="trd-header trd-fixed-header">
            <!-- Topbar -->
            <div class="trd-header-topbar">
                <div class="container">
                    <div class="row">
                        <!-- contact info -->
                        <div class="trd-contact-infos pull-right">
                            <ul>
                                <li class="trd-header-info-phn"><h2 class="call-call-to-action">Για αξιόπιστο <a title="Ντετέκτιβ στην Αθήνα - Γραφείο Ιδιωτικών Ερευνών" style="font-size:17px" href="<?= base_url() ?>">ντετέκτιβ</a> καλέστε τώρα στο <a class="active" title="Ντετέκτιβ στην Αθήνα - Γραφείο Ιδιωτικών Ερευνών" href="tel:+30 210 321 8888">+30 210 321 8888</a></h2></li>
                                <li class="trd-header-info-location"><a target="_blank" title="Ντετέκτιβ στην Αθήνα - Γραφείο Ιδιωτικών Ερευνών" href="https://goo.gl/maps/2tPqavzQnR92">Αιόλου 100, Αθήνα</a></li>
                                <li class="trd-header-info-lang">
                                    <select class="trd-multilang-opt">
                                      <option <?= ($lang == 'en' ? 'selected' : '') ?> value="en">English</option>
                                      <option <?= ($lang == 'gr' ? 'selected' : '') ?> value="gr">Ελληνικά</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <!-- End -->

                        <!-- Social Links -->
                        <div class="trd-social-links ">
                            <ul>
                                <li class="trd-fb-icon">
                                    <a target="_blank" href="https://www.facebook.com/pages/Erevna-Private-Investigations/322818164430382">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="trd-twitter-icon">
                                    <a target="_blank" href="https://twitter.com/erevna2">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="trd-blogspot-icon">
                                    <a target="_blank" href="http://erevna24.blogspot.gr/">
                                        <i class="fa fa-google"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
            <!-- End -->

            <!-- Bottombar -->
            <div class="trd-header-bottombar">
                <!-- Navigation Menu start-->
                <nav class="navbar trd-main-menu" role="navigation">
                  <div class="container">
                    <div class="row">
                      <!-- Navbar Toggle -->
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>

                          <!-- Logo -->
                          <a class="navbar-brand" href="<?= base_url() ?>"><img class="logo" src="<?= base_url('assets/frontend/images/logo-header.png') ?>" alt="TRADE"></a>
                      </div>
                      <!-- Navbar Toggle End -->

                        <!-- navbar-collapse start-->
                        <div id="nav-menu" class="navbar-collapse trd-menu-wrapper collapse" role="navigation">
                            <!-- Menu -->
                            <ul class="nav navbar-nav trd-menus">
                                <li class="active">
                                    <a href="<?= base_url() ?>">Αρχική</a>
                                </li>
                                <li>
                                    <a href="#">Γραφεία Ερευνών</a>

                                    <ul class="trd-dropdown-menu">

                                        <li>
                                            <a href="<?= base_url('αθηνα-κεντρο-ντετεκτιβ.html') ?>">ΝΤΕΤΕΚΤΙΒ ΑΘΗΝΑ</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('κηφισια-ντετεκτιβ.html') ?>">ΝΤΕΤΕΚΤΙΒ ΚΗΦΙΣΙΑ</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('πειραιας-ντετεκτιβ.html') ?>">ΝΤΕΤΕΚΤΙΒ ΠΕΙΡΑΙΑ</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('γλυφαδα-ντετεκτιβ.html') ?>">ΝΤΕΤΕΚΤΙΒ ΓΛΥΦΑΔΑ</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('θεσσαλονικη-ντετεκτιβ.html') ?>">ΝΤΕΤΕΚΤΙΒ ΘΕΣΣΑΛΟΝΙΚΗ</a>
                                        </li>
                                        <li>
                                          <a href="<?= base_url('ντετεκτιβ-πατρα.html') ?>">ΝΤΕΤΕΚΤΙΒ ΠΑΤΡΑ</a>
                                        </li>

                                    </ul>
                                </li>

                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ.html">Υπηρεσίες</a>
                                  <ul class="trd-dropdown-menu">
                                  <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΕΙΣ</a>
                                    <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-τηλεφωνου-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΤΗΛΕΦΩΝΟΥ</a>
                                      <ul class="trd-dropdown-menu trd-dropdown-menu-2 trd-dropdown-menu-3">
                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-τηλεφωνου-ντετεκτιβ/παρακολουθηση-κινητου-τηλεφωνου-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΚΙΝΗΤΟΥ ΤΗΛΕΦΩΝΟΥ</a></li>
                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-τηλεφωνου-ντετεκτιβ/παρακολουθηση-σταθερου-τηλεφωνου-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΣΤΑΘΕΡΟΥ ΤΗΛΕΦΩΝΟΥ</a>
                                      </li>
                                    </ul>
                                  </li>
                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-προσωπων-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΠΡΟΣΩΠΩΝ</a>
                                        <ul class="trd-dropdown-menu trd-dropdown-menu-2 trd-dropdown-menu-3">
                                        <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-προσωπων-ντετεκτιβ/παρακολουθηση-συζυγου-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΣΥΖΥΓΟΥ</a></li>
                                        <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/παρακολουθηση-προσωπων-ντετεκτιβ/παρακολουθηση-ατομου-ντετεκτιβ.html">ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΑΤΟΜΟΥ</a>
                                        </li>
                                      </ul>
                                    </li>
                                        <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/συσκευες-παρακολουθησης-ντετεκτιβ.html">ΣΥΣΚΕΥΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ</a></li>
                                        <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ/καμερες-παρακολουθησης-ντετεκτιβ.html">ΚΑΜΕΡΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ</a>
                                        </li>
                                      </ul>
                                    </li>
                                        <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ.html">ΕΥΡΕΣΗ / ΕΝΤΟΠΙΣΜΟΣ</a>
                                          <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                          <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/εντοπισμος-τηλεφωνου-ντετεκτιβ.html">ΕΝΤΟΠΙΣΜΟΣ ΤΗΛΕΦΩΝΟΥ</a>
                                            <ul class="trd-dropdown-menu trd-dropdown-menu-2 trd-dropdown-menu-3">
                                            <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/εντοπισμος-τηλεφωνου-ντετεκτιβ/εντοπισμος-κινητου-τηλεφωνου-ντετεκτιβ.html">ΕΝΤΟΠΙΣΜΟΣ ΚΙΝΗΤΟΥ ΤΗΛΕΦΩΝΟΥ</a></li>
                                            <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/εντοπισμος-τηλεφωνου-ντετεκτιβ/εντοπισμος-σταθερου-τηλεφωνου-ντετεκτιβ.html">ΕΝΤΟΠΙΣΜΟΣ ΣΤΑΘΕΡΟΥ ΤΗΛΕΦΩΝΟΥ</a>
                                            </li>
                                          </ul>
                                        </li>
                                            <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-τηλεφωνου-ντετεκτιβ.html">ΕΥΡΕΣΗ ΤΗΛΕΦΩΝΟΥ</a>
                                              <ul class="trd-dropdown-menu trd-dropdown-menu-2 trd-dropdown-menu-3">
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-τηλεφωνου-ντετεκτιβ/ευρεση-κινητου-τηλεφωνου-ντετεκτιβ.html">ΕΥΡΕΣΗ ΚΙΝΗΤΟΥ ΤΗΛΕΦΩΝΟΥ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-τηλεφωνου-ντετεκτιβ/ευρεση-σταθερου-τηλεφωνου-ντετεκτιβ.html">ΕΥΡΕΣΗ ΣΤΑΘΕΡΟΥ ΤΗΛΕΦΩΝΟΥ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-τηλεφωνου-ντετεκτιβ/ευρεση-αριθμου-κινητου-τηλεφωνου-ντετεκτιβ.html">ΕΥΡΕΣΗ ΑΡΙΘΜΟΥ ΚΙΝΗΤΟΥ ΤΗΛΕΦΩΝΟΥ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-τηλεφωνου-ντετεκτιβ/ευρεση-αριθμου-σταθερου-τηλεφωνου-ντετεκτιβ.html">ΕΥΡΕΣΗ ΑΡΙΘΜΟΥ ΣΤΑΘΕΡΟΥ ΤΗΛΕΦΩΝΟΥ</a>
                                              </li>
                                            </ul>
                                          </li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ευρεση-εξαφανισμενων-προσωπων-ντετεκτιβ.html">ΕΥΡΕΣΗ ΕΞΑΦΑΝΙΣΜΕΝΩΝ ΠΡΟΣΩΠΩΝ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/εντοπισμος-συσκευων-παρακολουθησης-ντετεκτιβ.html">ΕΝΤΟΠΙΣΜΟΣ ΣΥΣΚΕΥΩΝ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/εντοπισμος-παγιδευμενων-τηλεφωνων-ντετεκτιβ.html">ΕΝΤΟΠΙΣΜΟΣ ΠΑΓΙΔΕΥΜΕΝΩΝ ΤΗΛΕΦΩΝΩΝ</a></li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ/ανιχνευτης-ψευδους-ντετεκτιβ.html">ΑΝΙΧΝΕΥΤΗΣ ΨΕΥΔΟΥΣ</a>
                                              </li>
                                            </ul>
                                          </li>
                                              <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ.html">ΑΠΙΣΤΙΑ / ΔΙΑΖΥΓΙΟ</a>
                                                <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ/απιστια-συντροφου-ντετεκτιβ.html">ΑΠΙΣΤΙΑ ΣΥΝΤΡΟΦΟΥ</a></li>
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ/απιστια-συζυγου-μοιχεια-ντετεκτιβ.html">ΑΠΙΣΤΙΑ ΣΥΖΥΓΟΥ (ΜΟΙΧΕΙΑ)</a></li>
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ/διαζυγιο-συλλογη-στοιχειων-ντετεκτιβ.html">ΔΙΑΖΥΓΙΟ ΣΥΛΛΟΓΗ ΣΤΟΙΧΕΙΩΝ</a></li>
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ/διαζυγιο-διατροφη-ντετεκτιβ.html">ΔΙΑΖΥΓΙΟ ΔΙΑΤΡΟΦΗ</a></li>
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ/τεστ-πατροτητας-ντετεκτιβ.html">ΤΕΣΤ ΠΑΤΡΟΤΗΤΑΣ</a>
                                                </li>
                                              </ul>
                                            </li>
                                                <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παιδι-και-γονεις-ντετεκτιβ.html">ΠΑΙΔΙ ΚΑΙ ΓΟΝΕΙΣ</a>
                                                  <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                                  <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παιδι-και-γονεις-ντετεκτιβ/ναρκωτικα-και-εφηβεια-ντετεκτιβ.html">ΝΑΡΚΩΤΙΚΑ ΚΑΙ ΕΦΗΒΕΙΑ</a></li>
                                                  <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παιδι-και-γονεις-ντετεκτιβ/προστασια-παιδιων-απο-το-διαδικτυο-ντετεκτιβ.html">ΠΡΟΣΤΑΣΙΑ ΠΑΙΔΙΩΝ ΑΠΟ ΤΟ ΔΙΑΔΙΚΤΥΟ</a></li>
                                                  <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/παιδι-και-γονεις-ντετεκτιβ/απαγωγες-παιδιων-ντετεκτιβ.html">ΑΠΑΓΩΓΕΣ ΠΑΙΔΙΩΝ</a>
                                                  </li>
                                                </ul>
                                              </li>
                                                  <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ.html">ΕΤΑΙΡΙΚΕΣ ΕΡΕΥΝΕΣ</a>
                                                    <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ/βιομηχανικη-κατασκοπεια-ντετεκτιβ.html">ΒΙΟΜΗΧΑΝΙΚΗ ΚΑΤΑΣΚΟΠΕΙΑ</a></li>
                                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ/απαιτησεις-ασφαλιστικων-η-εμπορικων-εταιριων-ντετεκτιβ.html">ΑΠΑΙΤΗΣΕΙΣ ΑΣΦΑΛΙΣΤΙΚΩΝ Η ΕΜΠΟΡΙΚΩΝ ΕΤΑΙΡΕΙΩΝ</a></li>
                                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ/ναυτιλιακες-ερευνες-ντετεκτιβ.html">ΝΑΥΤΙΛΙΑΚΕΣ ΕΡΕΥΝΕΣ</a></li>
                                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ/ηλεκτρονικο-εγκλημα-ντετεκτιβ.html">ΗΛΕΚΤΡΟΝΙΚΟ ΕΓΚΛΗΜΑ</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                    <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ.html">ΕΙΔΙΚΕΣ ΕΡΕΥΝΕΣ</a>
                                                      <ul class="trd-dropdown-menu trd-dropdown-menu-2">
                                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ/προγαμιαιος-ελεγχος-ντετεκτιβ.html">ΠΡΟΓΑΜΙΑΙΟΣ ΕΛΕΓΧΟΣ</a></li>
                                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ/σεξουαλικη-παρενοχληση-ντετεκτιβ.html">ΣΕΞΟΥΑΛΙΚΗ ΠΑΡΕΝΟΧΛΗΣΗ</a></li>
                                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ/συλλογη-στοιχειων-ντετεκτιβ.html">ΣΥΛΛΟΓΗ ΣΤΟΙΧΕΙΩΝ</a></li>
                                                      <li><a href="<?= base_url() ?>υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ/αντιμετρα-ασφαλειας-ντετεκτιβ.html">ΑΝΤΙΜΕΤΡΑ ΑΣΦΑΛΕΙΑΣ</a>
                                                      </li>
                                                    </ul>
                                                  </li>
                                                </ul>
                                              </li>
                                <li>
                                    <a href="<?= base_url('πιστοποιησεις-ντετεκτιβ.html') ?>">Πιστοποιήσεις</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('επικοινωνια-ντετεκτιβ.html') ?>">Επικονωνία</a>
                                </li>
                            </ul>
                            <!-- End -->
                        </div>
                        <!-- navbar-collapse end-->

                        <!-- Search -->
                        <!-- <div class="trd-search-wrapper">
                            <a href="#" class="trd-search-icon">
                                <i class="fa fa-search"></i>
                            </a>
                        </div> -->
                        <!-- End -->
                    </div>
                  </div>
                </nav>
                <!-- Navigation Menu end-->
            </div>
            <!-- End -->
        </header>
        <!-- HEADER END -->


        <!-- HERO SLIDER SECTION -->
        <section class="trd-hero-slider-section">
            <div class="slider-pro trd-hero-slider" id="trd-hero-slider">
                <div class="sp-slides">

                    <!-- Slides -->
                    <div class="sp-slide trd-main-slides">
                        <img class="sp-image" src="<?= base_url() ?>assets/frontend/images/slider/idiotiki_erevna.jpg" alt="Ιδιωτική Έρευνα - Ντετέκτιβ" title="Ιδιωτική Έρευνα - Ντετέκτιβ"/>

                        <div class="sp-layer trd-slider-img trd-mac-img" data-position="bottomCenter" data-vertical="-25" data-horizontal="125" data-show-delay="500" data-hide-delay="200" data-show-transition="left" data-hide-transition="right">
                            <img src="<?= base_url() ?>assets/frontend/images/shape-overlay.png" alt="Γραφείο Ιδιωτικών Ερευνών - Overlay" title="Γραφείο Ιδιωτικών Ερευνών - Overlay">
                        </div>

                        <h3 class="sp-layer trd-slider-text-big"
                         data-position="center" data-vertical="-130"  data-horizontal="150"  data-show-transition="left" data-hide-transition="up" data-show-delay="1000" data-hide-delay="200">
                            ΙΔΙΩΤΙΚΕΣ ΕΡΕΥΝΕΣ, ΙΔΙΩΤΙΚΕΣ ΕΡΕΥΝΕΣ ΑΘΗΝΑ<br> <span class="trd-highlight-text">ΓΡΑΦΕΙΟ ΕΡΕΥΝΩΝ</span>
                         </h3>

                        <p class="sp-layer trd-slider-text-small"
                         data-position="center" data-vertical="90" data-horizontal="315" data-show-delay="1500" data-hide-delay="200" data-show-transition="down" data-hide-transition="down">
                            Ιδιωτικές έρευνες από το μεγαλύτερο γραφείο ιδιωτικών ερευνών στην Αθήνα
                        </p>

                        <div class="sp-layer trd-hero-header-btns" data-position="center" data-vertical="260" data-horizontal="-45" data-show-delay="2000" data-hide-delay="200" data-show-transition="down" data-hide-transition="up">
                            <a title="Υπηρεσίες Ιδιωτικής Έρευνας" href="<?= base_url('υπηρεσιες-ντετεκτιβ.html') ?>" class="trd-btn">Υπηρεσίες</a>
                        </div>
                    </div>
                    <!-- Slides End -->


                    <!-- Slides -->
                    <!-- <div class="sp-slide trd-main-slides">
                        <img class="sp-image" src="<?= base_url() ?>assets/frontend/images/slider/idiotikos_erevnitis.jpg" alt="Slider Image"/>

                        <div class="sp-layer trd-slider-img trd-mac-img" data-position="bottomCenter" data-vertical="-25" data-horizontal="125" data-show-delay="500" data-hide-delay="200" data-show-transition="left" data-hide-transition="right">
                            <img src="<?= base_url() ?>assets/frontend/images/shape-overlay.png" alt="Triangle Shape">
                        </div>

                        <h3 class="sp-layer trd-slider-text-big"
                         data-position="center" data-vertical="-130"  data-horizontal="150"  data-show-transition="left" data-hide-transition="up" data-show-delay="1000" data-hide-delay="200">
                            ΙΔΙΩΤΙΚΟΣ ΕΡΕΥΝΗΤΗΣ, ΙΔΙΩΤΙΚΟΣ ΕΡΕΥΝΗΤΗΣ ΑΘΗΝΑ<br> <span class="trd-highlight-text">ΕΡΕΥΝΗΤΗΣ</span>
                         </h3>

                        <p class="sp-layer trd-slider-text-small"
                         data-position="center" data-vertical="90" data-horizontal="315" data-show-delay="1500" data-hide-delay="200" data-show-transition="down" data-hide-transition="down">
                            Ιδιωτικός ερευνητής στην Αθήνα με αξιοπιστία, εχεμύθεια και διεθνείς συνεργασία
                        </p>

                        <div class="sp-layer trd-hero-header-btns" data-position="center" data-vertical="260" data-horizontal="100" data-show-delay="2000" data-hide-delay="200" data-show-transition="down" data-hide-transition="up">
                            <a title="Επικοινωνία με τον Ιδιώτικο Ερευνητή Αθήνα" href="<?= base_url('επικοινωνια-ντετεκτιβ.html') ?>" class="trd-btn">Επικοινωνία</a>
                        </div>
                    </div> -->



                </div>
            </div>
        </section>
        <!-- HERO SLIDER SECTION END -->

        <!-- CTA SECTION -->
        <section class="trd-cta-section">
            <div class="container">
                <div class="row">
                    <div class="trd-cta-wrapper">
                        <h1 style="display: inline;font-weight:normal">Γραφεία Ιδιωτικών Ερευνών - <span class="trd-highlight-text">"ΕΡΕΥΝΑ"</span> </h1>
                        <a title="Επικοινωνία Γραφεία Ιδιωτικών Ερευνών - ΕΡΕΥΝΑ" href="<?= base_url('επικοινωνια-ντετεκτιβ.html') ?>" class="trd-btn trd-btn-alt" style="font-weight:normal">Επικοινωνήστε Μαζί Μας Τώρα!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA SECTION END -->

        <!-- SERVICE SECTION -->
        <section class="trd-service-section trd-section">
            <div class="container">
                <div class="row">
                    <!-- About Section -->
                    <div class="col-md-3 col-sm-3 col-xs-12 trd-text-link-section">
                        <div class="trd-text-link-wrapper">
                            <h3 class="trd-section-tittle">Επιλέγω το  <br><span class="trd-highlight-text">καλύτερο</span> γραφείο ιδιωτικών ερευνών</h3>
                            <p>Διότι δίνει αξία στην προσωπική μου υπόθεση με το δέοντα σεβασμό και μου αξίζει να συνεργάζομαι μόνο με τους κορυφαίους</p>
                            <a href="<?= base_url('υπηρεσιες-ντετεκτιβ.html') ?>" class="trd-details-link">Υπηρεσίες</a>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Icon with text -->
                    <div class="col-md-3 col-sm-3 col-xs-12 trd-icon-top-with-text">
                        <div class="trd-icon-wrapper">
                            <!-- <i class="tradeicon-trd-coffee-mug"></i> -->
                            <i class="fa-bell-slash-o fa"></i>
                        </div>

                        <div class="trd-details">
                            <h3>
                                ΕΧΕΜΥΘΕΙΑ
                            </h3>

                            <p>Η εχεμύθεια είναι απαραίτητη προϋπόθεση σε κάθε σύγχρονη προσέγγιση μίας υπόθεσης, για αυτό ξεχωρίζω αυτό το γραφείο ερευνών.</p>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Icon with text -->
                    <div class="col-md-3 col-sm-3 col-xs-12 trd-icon-top-with-text">
                        <div class="trd-icon-wrapper">
                          <i class="fa fa-trophy"></i>
                            <!-- <i class="tradeicon-trd-trophy"></i> -->
                        </div>

                        <div class="trd-details">
                            <h3>
                                ΑΞΙΟΠΙΣΤΙΑ
                            </h3>

                            <p>Η αξιοπιστία αποτελεί επίτευγμα της πολυετούς εμπειρίας του γραφείου ερευνών «ΕΡΕΥΝΑ», και είναι εγγύηση επιτυχίας.</p>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Icon with text -->
                    <div class="col-md-3 col-sm-3 col-xs-12 trd-icon-top-with-text">
                        <div class="trd-icon-wrapper">
                            <i class="fa-adjust fa"></i>
                            <!-- <i class="tradeicon-trd-chart-board"></i> -->
                        </div>

                        <div class="trd-details">
                            <h3>
                                ΔΙΑΚΡΙΤΙΚΟΤΗΤΑ
                            </h3>

                            <p>Πάντα η αντιμετώπιση γίνεται με διακριτικότητα και μεγάλη προσοχή στο σχεδιασμό μίας στρατηγικής και το έμπειρο προσωπικό δίνει τη δέουσα προσοχή.</p>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </section>
        <!-- SERVICE SECTION END -->

        <!-- KEY TO SUCCESS SECTION -->
        <section class="trd-key-success-section trd-section trd-gray-section">
            <div class="container">
                <div class="row">
                    <div class="trd-section-title-wrapper col-md-12 col-sm-12 col-xs-12">
                        <h3 class="trd-section-tittle">Υπηρεσίες Γραφείου <span class="trd-highlight-text">Ιδιωτικών Ερευνών </span></h3>
                        <a title="Υπηρεσίες Γραφείου Ιδιωτικών Ερευνών" href="<?= base_url('υπηρεσιες-ντετεκτιβ.html') ?>" class="trd-details-link">Όλες οι Υπηρεσίες</a>
                    </div>


                    <div class="trd-key-to-success">

                        <!-- Imagebox with Text -->
                        <div class="col-md-4 col-sm-4 col-xs-12 trd-imagebox-with-text-wrapper appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="trd-imagebox-with-text">
                                <div class="trd-image-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/parakolouthisi_atomou.jpg" alt="ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΑΤΟΜΟΥ" title="ΥΠΗΡΕΣΙΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΕΙΣ: ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΤΗΛΕΦΩΝΟΥ, ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΠΡΟΣΩΠΩΝ, ΣΥΣΚΕΥΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ">
                                </div>

                                <div class="trd-imagebox-details">
                                    <h3>
                                        <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ.html') ?>">ΠΑΡΑΚΟΛΟΥΘΗΣΕΙΣ</a>
                                    </h3>
                                    <p>ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΤΗΛΕΦΩΝΟΥ, ΠΑΡΑΚΟΛΟΥΘΗΣΗ ΠΡΟΣΩΠΩΝ, ΣΥΣΚΕΥΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ, ΚΑΜΕΡΕΣ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ...</p>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Imagebox with details -->
                        <div class="col-md-4 col-sm-4 col-xs-12 trd-imagebox-with-text-wrapper appear fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
                            <div class="trd-imagebox-with-text">
                                <div class="trd-image-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/euvresi_entopismos.jpg" alt="ΕΥΡΕΣΗ ΚΑΙ ΕΝΤΟΠΙΣΜΟΣ" title="ΥΠΗΡΕΣΙΕΣ ΕΥΡΕΣΗΣ ΚΑΙ ΕΝΤΟΠΙΣΜΟΥ: ΕΝΤΟΠΙΣΜΟΣ ΤΗΛΕΦΩΝΟΥ, ΕΥΡΕΣΗ ΤΗΛΕΦΩΝΟΥ, ΕΥΡΕΣΗ ΕΞΑΦΑΝΙΣΜΕΝΩΝ ΠΡΟΣΩΠΩΝ ">
                                </div>

                                <div class="trd-imagebox-details">
                                    <h3>
                                        <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ.html') ?>">ΕΥΡΕΣΗ / ΕΝΤΟΠΙΣΜΟΣ</a>
                                    </h3>
                                    <p>ΕΝΤΟΠΙΣΜΟΣ ΤΗΛΕΦΩΝΟΥ, ΕΥΡΕΣΗ ΤΗΛΕΦΩΝΟΥ, ΕΥΡΕΣΗ ΕΞΑΦΑΝΙΣΜΕΝΩΝ ΠΡΟΣΩΠΩΝ, ΕΝΤΟΠΙΣΜΟΣ ΣΥΣΚΕΥΩΝ ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ...</p>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Imagebox with details -->
                        <div class="col-md-4 col-sm-4 col-xs-12 trd-imagebox-with-text-wrapper appear fadeIn" data-wow-duration="1s" data-wow-delay=".7s">
                            <div class="trd-imagebox-with-text">
                                <div class="trd-image-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/apistia_diazigio.jpg" alt="ΑΠΙΣΤΙΑ ΚΑΙ ΔΙΑΖΥΓΙΟ" title="ΤΕΣΤ ΠΑΤΡΟΤΗΤΑΣ, ΔΙΑΖΥΓΙΟ ΔΙΑΤΡΟΦΗ, ΔΙΑΖΥΓΙΟ ΣΥΛΛΟΓΗ ΣΤΟΙΧΕΙΩΝ, ΑΠΙΣΤΙΑ ΣΥΖΥΓΟΥ (ΜΟΙΧΕΙΑ)">
                                </div>

                                <div class="trd-imagebox-details">
                                    <h3>
                                        <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ.html') ?>">ΑΠΙΣΤΙΑ / ΔΙΑΖΥΓΙΟ</a>
                                    </h3>
                                    <p>ΤΕΣΤ ΠΑΤΡΟΤΗΤΑΣ, ΔΙΑΖΥΓΙΟ ΔΙΑΤΡΟΦΗ, ΔΙΑΖΥΓΙΟ ΣΥΛΛΟΓΗ ΣΤΟΙΧΕΙΩΝ, ΑΠΙΣΤΙΑ ΣΥΖΥΓΟΥ (ΜΟΙΧΕΙΑ), ΑΠΙΣΤΙΑ ΣΥΝΤΡΟΦΟΥ...</p>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                    </div>
                </div>
            </div>
        </section>

        <section class="trd-counter-section trd-section" style="background-color:#fff;">
            <div class="container">
                <div class="row">
                    <!-- Counter Item -->
                    <div class="col-md-4 col-sm-4 col-xs-12 trd-counter trd-mulicolor-counter">
                        <span class="trd-count" data-from="0" data-to="540">428</span>
                        <p>Ικανοποιημένοι Πελάτες</p>
                    </div>
                    <!-- End -->

                    <!-- Counter Item -->
                    <div class="col-md-4 col-sm-4 col-xs-12 trd-counter trd-mulicolor-counter trd-count-client">
                        <span class="trd-count" data-from="0" data-to="231">0</span>
                        <p>Ευτυχισμένες Οικογένιες</p>
                    </div>
                    <!-- End -->

                    <!-- Counter Item -->
                    <div class="col-md-4 col-sm-4 col-xs-12 trd-counter trd-mulicolor-counter">
                        <span class="trd-count" data-from="0" data-to="1678">0</span>
                        <p>Λυμένες υποθέσεις</p>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </section>
        <!-- COUNTER SECTION END -->




        <!-- IMAGEBOX SECTION -->
        <section class="trd-category-section">
            <div class="container-fluid">
                <div class="row">
                    <!-- Imagebox -->
                    <div class="trd-image-with-overlay">
                        <img src="<?= base_url() ?>assets/frontend/images/grafeio-erevnon-athina.jpg" alt="Γραφείο Ερευνών Αθήνα" title="Γραφείο Ερευνών Αθήνα">
                        <a href="<?= base_url('αθηνα-κεντρο-ντετεκτιβ.html') ?>" class="trd-img-overlay">
                            <h3>Γραφείο Ερευνών Αθήνα</h3>
                        </a>
                    </div>
                    <!-- End -->

                    <!-- Imagebox -->
                    <div class="trd-image-with-overlay">
                        <img src="<?= base_url() ?>assets/frontend/images/grafeio-erevnon-thessaloniki.jpg" alt="Γραφείο Ερευνών Θεσσαλονίκη" title="Γραφείο Ερευνών Θεσσαλονίκη">
                        <a href="<?= base_url('θεσσαλονικη-ντετεκτιβ.html') ?>" class="trd-img-overlay">
                            <h3>Γραφείο Ερευνών Θεσσαλονίκη</h3>
                        </a>
                    </div>
                    <!-- End -->

                    <!-- Imagebox -->
                    <div class="trd-image-with-overlay">
                        <img src="<?= base_url() ?>assets/frontend/images/grafeio-erevnon-patra.jpg" alt="Γραφείο Ερευνών Πάτρα" title="Γραφείο Ερευνών Πάτρα">
                        <a href="<?= base_url('ντετεκτιβ-πατρα.html') ?>" class="trd-img-overlay">
                            <h3>Γραφείο Ερευνών Πάτρα</h3>
                        </a>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </section>
        <!-- IMAGEBOX SECTION END -->


        <!-- CLIENT TESTIMONIAL SECTION -->
        <section class="trd-client-testimonial-section trd-section">
            <div class="container">
                <div class="row">
                    <!-- Section Title -->
                    <div class="trd-section-title-wrapper">
                        <h3 class="trd-section-tittle">Τι λένε οι  <span class="trd-highlight-text">Πελάτες μας</span></h3>
                    </div>
                    <!-- End -->

                    <div id="trd-testimonial" class="trd-testimonial">
                        <!-- Slides -->
                        <div class="trd-testimonial-slides">
                            <div class="trd-testimonial-text">
                                <p>Ο σωστός ιδιωτικός ερευνητής με διαδικασίες πιστοποιημένες και αποτελεσματικότητα. Είχα συστάσεις και πήγα. Ευχαριστημένος. Συστήνω σε γνωστούς μου ανεπιφύλακτα. Μπράβο στην οργάνωση και στπ προσωπικό.</p>
                            </div>

                            <div class="trd-satisfied-user-info">
                                <div class="trd-user-img-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/sxolia_pelatwn_1.png" alt="Clients Image">
                                </div>
                                <h3>ΕΤΑΙΡΙΚΕΣ ΕΡΕΥΝΕΣ</h3>
                                <p>Χρήστος Μ.</p>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Slides -->
                        <div class="trd-testimonial-slides">
                            <div class="trd-testimonial-text">
                                <p>Αποτελεσματικός και διακριτικός. Ευχαριστώ πολύ.</p>
                            </div>
                            <div class="trd-satisfied-user-info">
                                <div class="trd-user-img-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/sxolia_pelatwn_2.png" alt="Clients Image">
                                </div>
                                <h3>ΠΑΙΔΙ ΚΑΙ ΓΟΝΕΙΣ</h3>
                                <p>Αλέξανδρος Τ.</p>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Slides -->
                        <div class="trd-testimonial-slides">
                            <div class="trd-testimonial-text">
                                <p>Στο γραφείο Ιδιωτικών Ερευνών "ΕΡΕΥΝΑ" χειρίστηκαν την  υπόθεση μου με πολύ μεγάλη προσοχή και διακριτικότητα, όπως τους το ζήτησα.  </p>
                            </div>

                            <div class="trd-satisfied-user-info">
                                <div class="trd-user-img-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/sxolia_pelatwn_3.png" alt="Clients Image">
                                </div>
                                <h3>ΕΙΔΙΚΕΣ ΕΡΕΥΝΕΣ</h3>
                                <p>Ιωάννα Κ.</p>
                            </div>
                        </div>
                        <!-- End -->
                        <!-- Slides -->
                        <div class="trd-testimonial-slides">
                            <div class="trd-testimonial-text">
                                <p>Εξαιρετικός κόσμος, χώρος υποδοχής, συμπεριφορά, εχεμύθεια κι αποτελεσματικότητα. Συνστήνω το Γραφείο ιδιωτικών ερευνών "ΕΡΕΥΝΑ" ανεπιφύλακτα.</p>
                            </div>

                            <div class="trd-satisfied-user-info">
                                <div class="trd-user-img-wrapper">
                                    <img src="<?= base_url() ?>assets/frontend/images/sxolia_pelatwn_1.png" alt="Clients Image">
                                </div>
                                <h3>ΕΤΑΙΡΙΚΕΣ ΕΡΕΥΝΕΣ</h3>
                                <p>Βασίλης Μ.</p>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
        </section>
        <!-- CLIENT TESTIMONIAL SECTION END -->


        <!-- CONTACT SECTION -->
        <section class="trd-contact-section trd-section">
            <!-- Google Map -->
            <div class="trd-map-wrapper">
                <div id="trd-map"></div>
            </div>
            <!-- End -->

            <!-- Contact Form -->
            <div class="trd-contact-form-sec">
                <h3 class="trd-section-tittle">Επικοινωνήστε <span class="trd-highlight-text">Μαζί Μας</span></h3>
                <br>
                <div class="trd-contact-form-wrapper">
                    <form id="contact-form" action="#">
                        <input type="text" name="name" id="trd-name" placeholder="Το Όνομά σας">
                        <input type="email" name="email" id="trd-email" placeholder="Το email σας">
                        <input type="text" name="subject" id="trd-subject" placeholder="Τι θα θέλατε να συζητήσουμε">
                        <input type="tel" name="phone" id="trd-phone" placeholder="Τηλέφωνο Επικοινωνίας">
                        <p id="form-errors" style="display:none;" class="col-md-7  "></p>
                        <div class="clearfix">  </div>
                        <button id="contact-button" type="submit" class="trd-btn">Αποστολή</button>
                    </form>
                </div>
            </div>
            <!-- End -->
        </section>
        <!-- CONTACT SECTION END -->


        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="row">
                    <!-- Footer Top -->
                    <div class="trd-footer-top">
                        <!-- About Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12 trd-footer-widget trd-about-widget">
                            <div class="trd-logo-wrapper">
                                <img src="<?= base_url() ?>assets/frontend/images/logo-footer.png" alt="Trade">
                            </div>

                            <p>Τα Γραφεία Ιδιωτικών Ερευνών "ΕΡΕΥΝΑ" (πρώην ονομασία Γραφεία Ντετέκτιβ) με έδρα την Αθήνα, δραστηριοποιούνται στην ιδιωτική έρευνα από το 1988.</p>
                        </div>
                        <!-- End -->

                        <!-- Useful Link Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12 trd-footer-widget trd-useful-link-widget">
                            <h3 class="trd-footer-widget-title">Γραφεία Ερευνών</h3>

                            <div class="trd-footer-widget-content">
                                <ul>
                                    <li><a href="#">ΕΥΡΕΣΗ / ΕΝΤΟΠΙΣΜΟΣ</a></li>
                                    <li><a href="#">ΑΠΙΣΤΙΑ / ΔΙΑΖΥΓΙΟ</a></li>
                                    <li><a href="#">ΠΑΙΔΙ ΚΑΙ ΓΟΝΕΙΣ</a></li>
                                    <li><a href="#">ΕΤΑΙΡΙΚΕΣ ΕΡΕΥΝΕΣ</a></li>
                                    <li><a href="#">ΕΙΔΙΚΕΣ ΕΡΕΥΝΕΣ</a></li>
                                    <li><a href="#">ΠΑΡΑΚΟΛΟΥΘΗΣΕΙΣ</a></li>

                                </ul>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Recent Post Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12 trd-footer-widget trd-recent-post-widget">
                            <h3 class="trd-footer-widget-title">Πιστοποιήσεις</h3>

                            <div class="trd-footer-widget-content">

                                <div class="trd-recent-post-wrapper">
                                    <!-- Post Item -->
                                    <div class="trd-recent-post-item">


                                        <p class="trd-post-date">Άδεια από το Υπουργείο Δημοσίας Τάξης - Αρχηγείο Ελληνικής Αστυνομίας αρ. αδείας 4891/7/1/50-Γ</p>
                                    </div>
                                    <!-- End -->

                                    <!-- Post Item -->
                                    <div class="trd-recent-post-item">


                                        <p class="trd-post-date">Υπουργείο προστασίας του πολίτη - Ελληνικής Αστυνομίας τμήμα ανάλυσης και αντιμετώπισης του εγκλήματος αρ. αδείας 4891/7/1/50-ΙΑ</p>
                                    </div>
                                    <hr>
                                    <a href="<?= base_url('πιστοποιησεις-ντετεκτιβ.html') ?>" style="color:#fff;" class="text-center">Όλες οι πιστοποιήσεις του γραφείου ερευνών</a>
                                    <!-- End -->
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Subscribe For Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12 trd-footer-widget trd-subscribe-widget">
                            <h3 class="trd-footer-widget-title">Επικοινωνία</h3>

                            <div class="trd-footer-widget-content">
                                <p style="margin-bottom: 15px;"><strong><i class="fa fa-map-marker"></i> Κεντρικά Γραφεία Ερευνών</strong></p>
                                <p>Αιόλου 100 & Σταδίου, Αθήνα</p>
                                <hr>
                                <p style="margin-bottom: 15px;"><strong><i class="fa fa-envelope"></i> info@erevna.gr</strong></p>
                                <hr>
                                <p style="margin-bottom: 15px;"><strong><i class="fa fa-phone "></i> Τηλεφωνικό Κέντρο 24ώρες</strong></p>
                                <a href="tel:+30 210 321 8888" style="margin-bottom:15px;"class="btn trd-btn">+30 210 321 8888</a>
                                <a href="tel:+30 6932 4444 25" class="btn trd-btn">+30 6932 4444 25</a>
                                <hr>
                                <a target="_blank" href="https://www.facebook.com/pages/Erevna-Private-Investigations/322818164430382">
                                    <i class="fa fa-facebook"></i>
                                </a>
    <a target="_blank" href="https://twitter.com/erevna2">
                                    <i class="fa fa-twitter"></i>
                                </a>
    <a target="_blank" href="http://erevna24.blogspot.gr/">
                                    <i class="fa fa-google"></i>
                                </a>

                            </div>
                        </div>
                        <!-- End -->
                    </div>
                    <!-- End -->
                    <div class="trd-footer-bottom text-center law-disclaimer">
                    <p>Σύμφωνα με το ΝΟΜΟ 3206/2003 ΦΕΚ 298/Α/23.12.2003 απαγορεύεται η χρήση των τίτλων:</p>
                    <p><a style="color:#fff" href="https://www.insider.com.gr/">ΝΤΕΤΕΚΤΙΒ</a> ή <a style="color:#fff" href="https://www.sotiropoulos-24h.gr/">ΝΤΕΤΕΚΤΙΒ ΓΡΑΦΕΙΑ</a> ή <a style="color:#fff" href="https://www.insider.com.gr/">ΓΡΑΦΕΙΑ ΕΡΕΥΝΩΝ</a> ή <a style="color:#fff" href="https://www.sotiropoulos-24h.gr/">ΙΔΙΩΤΙΚΟΣ ΕΡΕΥΝΗΤΗΣ</a> ή <a style="color:#fff" href="https://www.erevna.gr/">ΝΤΕΤΕΚΤΙΒ, ΓΡΑΦΕΙΑ ΙΔΙΩΤΙΚΩΝ ΕΡΕΥΝΩΝ</a> ή
                      <a style="color:#fff" href="https://www.specialist.gr/">ΝΤΕΤΕΚΤΙΒ, ΙΔΙΩΤΙΚΕΣ ΕΡΕΥΝΕΣ</a>.</p>

                  </div>
                    <!-- Footer Bottom -->
                    <div class="trd-footer-bottom">
                        <div class="trd-footer-menu col-sm-8">
                            <ul>
                                <li>
                                    <a href="<?= base_url() ?>">ΓΡΑΦΕΙΑ ΕΡΕΥΝΩΝ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ.html') ?>">ΥΠΗΡΕΣΙΕΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('πιστοποιησεις-ντετεκτιβ.html') ?>">ΠΙΣΤΟΠΟΙΗΣΕΙΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('συχνεσ-ερωτησεισ-ντετεκτιβ.html') ?>">ΣΥΧΝΕΣ ΕΡΩΤΗΣΕΙΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('επικοινωνια-ντετεκτιβ.html') ?>">ΕΠΙΚΟΙΝΩΝΙΑ</a>
                                </li>
                            </ul>
                        </div>

                        <div class="trd-copyright-info col-sm-4" >
                            <p>Copyright &copy; <?= date('Y') ?>. Developed by <a href="https://alexdev.gr/" class="trd-author-link">AlexDev Studio</a></p>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
            <!-- End -->
        </footer>
        <!-- FOOTER END -->


        <!-- jQuery -->
        <script src="<?= base_url() ?>assets/frontend/js/vendors/jquery.min.js"></script>
        <script type="text/javascript">
          //Mail form submit
          $('#contact-form').submit(function(e) {
            e.preventDefault();
            $('#form-errors').hide();
            $('#form-errors').removeClass('text-error');
            $('#form-errors').removeClass('text-success');
          var  name = $('#trd-name').val();
          var  email = $('#trd-email').val();
          var  subject = $('#trd-subject').val();
          var  phone = $('#trd-phone').val();
          if(name == '' || email == '' || subject  == '' || phone  == '' ){
            $('#form-errors').html('Παρακαλώ, συμπληρώστε όλα τα πεδία.');
            $('#form-errors').addClass('text-error');

          }else{
            $.post("<?= base_url('/sendEmail') ?>",
             {
               name : name,
               email : email,
               subject : subject,
               phone : phone
             },
             function(data, status){
                console.log(data + ' : ' + status);
             });
            // $('#trd-name').val('');
            // $('#trd-email').val('');
            // $('#trd-subject').val('');
            // $('#trd-phone').val('');
            $('#form-errors').html('Το μήνυμά σας έχει αποσταλεί. <br> Θα επικοινωνήσουμε μαζί σας το συντομότερο. ');
            $('#form-errors').addClass('text-success');
          }
            $('#form-errors').show();
            setTimeout(function() {
              $('#form-errors').fadeOut();
            }, 10000);


          });
        </script>
        <!-- Plugins -->
        <script src="<?= base_url() ?>assets/frontend/js/plugins.js"></script>



        <!-- GOOGLE MAP -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHm-2uwCZv8pQraYf5v6ez_mjcqDnyM9s"></script>
        <script src="<?= base_url() ?>assets/frontend/js/google-map-init.js"></script>

         <!-- Main JS -->
        <script src="<?= base_url() ?>assets/frontend/js/main.js"></script>


        <!-- Main scripts build from webpack -->
        <!-- <script src="<?= base_url() ?>assets/frontend/js/scripts.js"></script> -->

    </body>
</html>
