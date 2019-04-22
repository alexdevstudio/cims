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

    <body class="trd-home-template trd-homepage-one">
        <!-- HEADER -->
        <header class="trd-header trd-fixed-header">
            <!-- Topbar -->
            <div class="trd-header-topbar">
                <div class="container">
                    <div class="row">
                        <!-- contact info -->
                        <div class="trd-contact-infos pull-right">
                            <ul>
                                <li class="trd-header-info-phn"><h2 class="call-call-to-action">Για αξιόπιστο <a style="font-size:17px" href="<?= base_url() ?>">ντετέκτιβ</a> καλέστε τώρα στο <a class="active" href="tel:+30 210 321 8888">+30 210 321 8888</a></h2></li>
                                <li class="trd-header-info-location"><a target="_blank" href="https://goo.gl/maps/2tPqavzQnR92">Αιόλου 100, Αθήνα</a></li>
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
        <section class="trd-false-div" style="height: 132px; "></section>
        <!-- PAGE HEADER -->
        <section class="trd-page-breadcumb-header">
            <div class="container">
                <div class="row">

                    <div class="trd-breadcumb-wrapper pull-right">
                        <?php
                        asort($breadcumbs);
                        foreach ($breadcumbs as $breadcumb) {
                          echo " $breadcumb";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- PAGE HEADER END -->

        <!-- PAGE CONTENTS -->
        <section class="trd-page-contents-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="trd-sidebar trd-sidebar-left col-md-3 col-sm-4 col-xs-12">
                        <!-- Widget -->
                        <h3 class="text-center">ΥΠΗΡΕΣΙΕΣ</h3>
                        <div class="trd-sidebar-widget trd-pagelink-widget">

                            <ul>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/παρακολουθησεις-ντετεκτιβ.html') ?>">ΠΑΡΑΚΟΛΟΥΘΗΣΕΙΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/ευρεση-εντοπισμος-ντετεκτιβ.html') ?>">ΕΥΡΕΣΗ / ΕΝΤΟΠΙΣΜΟΣ</a>
                                </li>
                                <li class="current">
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/απιστια-διαζυγιο-ντετεκτιβ.html') ?>">ΑΠΙΣΤΙΑ / ΔΙΑΖΥΓΙΟ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/παιδι-και-γονεις-ντετεκτιβ.html') ?>">ΠΑΙΔΙ ΚΑΙ ΓΟΝΕΙΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/εταιρικες-ερευνες-ντετεκτιβ.html') ?>">ΕΤΑΙΡΙΚΕΣ ΕΡΕΥΝΕΣ</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('υπηρεσιες-ντετεκτιβ/ειδικες-ερευνες-ντετεκτιβ.html') ?>">ΕΙΔΙΚΕΣ ΕΡΕΥΝΕΣ</a>
                                </li>


                            </ul>
                        </div>
                        <h3 class="text-center">ΓΡΑΦΕΙΑ ΕΡΕΥΝΩΝ</h3>
                        <div class="trd-sidebar-widget trd-pagelink-widget">
                            <ul>
                                <li>
                                    <a href="#">ΝΤΕΤΕΚΤΙΒ ΑΘΗΝΑ</a>
                                </li>
                                <li>
                                    <a href="#">ΝΤΕΤΕΚΤΙΒ ΠΕΙΡΑΙΑ</a>
                                </li>
                                <li class="current">
                                    <a href="#">ΝΤΕΤΕΚΙΒ ΚΗΦΙΣΙΑ</a>
                                </li>
                                <li>
                                    <a href="#">ΝΤΕΤΕΚΙΒ ΓΛΥΦΑΔΑ</a>
                                </li>
                                <li>
                                    <a href="#">ΝΤΕΤΕΚΤΙΒ ΘΕΣΣΑΛΟΝΙΚΗ</a>
                                </li>
                                <li>
                                    <a href="#">ΝΤΕΤΕΚΤΙΒ ΠΑΤΡΑ</a>
                                </li>


                            </ul>
                        </div>
                        <!-- End -->
                    </div>
                    <!-- Sidebar End -->
