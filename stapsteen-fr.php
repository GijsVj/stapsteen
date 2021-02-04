<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: login-fr.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap"
      rel="stylesheet"
    />
    <title>StapSteen</title>
  </head>

  <body id="top">
    <header>
      <nav>
        <div class="navside">
          <ul>
            <li><a class="geel" href="#about-us">Qui sommes-nous?</a></li>
            <li><a class="watdoen" href="#what">Que faisons-nous?</a></li>
            <li><a class="helpen" href="#handje">Aidant!</a></li>
            <li><a class="ons" href="#contact">Rejoins-nous</a></li>
            <li><a class="doni" href="#donatie">faire un don</a></li>
          </ul>
        </div>
      </nav>
      <nav>
        <div class="taalnav">
          <ul>
            <li><a class="fr" href="./index.php">Nl</a></li>
            <li><a class="en" href="stapsteen-en.php">Eng</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <section id="home">
        <img class="logo-back" src="img/nieuw-logo.png" alt="" />
        <div>
          <p class="passie">des gens passionnés,</p>
          <p class="steunpunt">un point d'appui,</p>
          <h1 class="staphome">STAPSTEEN</h1>
        </div>
      </section>

      <section class="sticky">
        <div class="logotop">
          <a href="#top"><img src="img/Logo+tekst.png" alt="" /></a>
        </div>
        <section id="about-us">
          <div class="titels1">
            <p class="wbo">Qu’est-ce qui nous émeu?</p>
            <h2 class="wzw">Qui sommes-nous?</h2>
          </div>

          <div class="text">
            <p>
              Nous sommes <b>un point d’appui</b> pour les familles vulnérables
              de <b>Bruxelles</b>, <br />
              qui ont du mal à joindre les deux bouts et/ou de trouver le lien
              avec la société.
            </p>
          </div>
          <div class="fotoentext">
            <img
              class="wzwfoto"
              src="img/conner-baker-7FC-84Ap_IU-unsplash.jpg"
              alt=""
            />
            <div class="textfoto">
              <p>
                Des <b>bénévoles</b> passionnés, qui veulent être un point
                d’appui pour les familles que nous rencontrons.
              </p>
              <p>
                Notre croyance <b>chrétienne</b> est notre source de motivation
                et notre inspiration.
              </p>
              <p>
                Nombreux sont les familles qui en ce jour se posent
                <b>la question</b> comment faire afin d’offrir des valeurs
                chrétiennes au membres de leur famille.
                <br />
                Nous voulons être leurs <b>compagnon de voyage</b> en leurs
                offrant formation et rencontres autour de ces differents themes.
              </p>
            </div>
          </div>
        </section>
        <section id="what">
          <div class="titels">
            <p class="bezoek">Equipe de visite</p>
            <h2 class="wzw">Que faisons-nous?</h2>
            <p class="spelo">Ludothèque</p>
            <p class="kids">StapSteen Kids</p>
          </div>
          <div class="activi">
            <div>
              <h3>StapSteen Kids</h3>
              <p>
                un <b>club pour les enfants</b> des familles dans les environs
                de notre maison a Laeken. Ce club pour enfants se passe toutes
                les deux semaines le dimanche après-midi.
              </p>
              <p>
                Les <b>activités</b> peuvent aller de l’artisanat à cuisson ou
                sports et jeux. <br />Nous essayons d’offrir un programme varié.
              </p>
            </div>
            <img src="img/austin-pacheco-FtL07GM9Q7Y-unsplash.jpg" alt="" />
          </div>
          <div class="activi2">
            <img src="img/abigail-miller-r4sxIf0gTfs-unsplash.jpg" alt="" />
            <div>
              <h3>Equipe de visite</h3>
              <p>
                Les bénévoles qui <b>soutiennent une famille</b> pour leur
                rendre visite régulièrement à la maison et pour participer à
                leurs activités quotidiennes et/ou d’un service pratique, c’est
                notre équipe de visite.
              </p>
              <p>
                Par la présence régulière des bénévoles au sein de la famille,
                nous voulons augmenter les capacités et les compétences des
                éducateurs ,élargir le réseau social de la famille et contribuer
                de facon préventive au <b>bien-être des enfants</b>.
              </p>
            </div>
          </div>
          <div class="activi3">
            <div>
              <h3>Ludothèque</h3>
              <p>
                Dans notre Ludothèque vous pouvez emprunter des
                <b>jeux de table</b> comme vous le faites dans une bibliothèque.
              </p>
              <p>
                Nous avons une <b>gamme variée</b> de jeux pour les enfants de 1
                à 12 ans.
              </p>
              <p>
                Nous voulons rompre l’isolement, qui est particulière au
                contexte urbain, en <b>stimulant ce lieu de rencontre</b>.
                <br />La ludothèque est une manière accessible aux parents et
                enfants ou non seulement ils peuvent se sentir bienvenus mais
                également apprécié.
              </p>
              <p>
                <b>Heures d'ouverture:</b> mercredi de 13h à 17h <br />
                En raison de covid uniquement possible sur rendez-vous, via 0471
                86 01 23
              </p>
            </div>
            <img src="img/sigmund-OV44gxH71DU-unsplash.jpg" alt="" />
          </div>
        </section>

        <section class="memory">
          <a href="dist/memory.html">Jeu de Memory</a>
          <a href="">Download le jeux memory et l'imprimer!</a>
        </section>

        <section id="handje">
          <div class="titels">
            <p class="bezoek">Devenir bénévole?</p>
            <h2 class="wzw">Aidant!</h2>
          </div>
          <div class="texthelp">
            <p>
              les <b>bénévoles de StapSteen</b> veulent d’être un soutien à la
              famille, où les parents, pour des raisons diverses, <br />
              ont des difficulteés pour offrir à leurs jeunes enfants (jusqu’à
              12 ans) l’affection, la sécurité et la structure dont ils ont
              besoin. De <b>StapSteen vrijwilliger</b> wil een gezin
              ondersteunen waar de ouders, om verschillende redenen, <br />
              het moeilijk hebben om aan hun jonge kinderen (tot 12 jaar) de
              nodige nestwarmte, geborgenheid <br />
              en structuur te bieden.
            </p>
          </div>
          <div class="form">
            <img src="img/austin-kehmeier-lyiKExA4zQA-unsplash.jpg" alt="" />
            <div class="formtext">
              <div class="vrijplat">
                <a href="login-fr.php">plateforme de bénévolat</a>
              </div>
              <p>
                Vous souhaitez plus d’informations ou vous voulez <br />
                travailler en collaboration avec l’équipe de visite? <br />
                <b>Inscrivez-vous</b> comme bénévole sur ce site Web!
              </p>
              <form class="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                  <p>Votre nom:</p>
                  <input  type="text" name="username" class="form-control" value="" />
                  <p>Mot de passe:</p>
                  <input type="password" name="password" class="form-control" value="">
                  <p>Répéter le mot de passe:</p>
                  <input type="password" name="confirm_password" class="form-control" value="">
                </div>
                <div class="form-group">
                  <button type="submit" value="Submit">S'inscrire</button>
                  <button type="reset" value="Reset">Réinitialiser</button>
              </div>
              <p  style="margin-left:7%">Vous avez déjà un compte? <a href="login-en.php">Connectez-vous ici</a>.</p>
              </form>
            </div>
          </div>
        </section>
        <section id="contact">
          <div class="titels">
            <p class="bezoek">Une question urgente?</p>
            <h2 class="wzw">Rejoins-nous</h2>
            <p class="info">Plus d'info?</p>
          </div>
          <div class="bereiken">
          <form class="contact2" action="POST" data-netlify="true">
              <h4>Formulaire de contact</h4>
              <div>
                <p>Votre nom:</p>
                <input type="text" name="name" id="name" />
                <p>Votre e-mail:</p>
                <input type="email" name="email" id="email" />
                <p>Votre message:</p>
                <textarea
                  name="message"
                  id="message"
                  cols="50"
                  rows="4"
                ></textarea>
              </div>
              <button>Envoyer</button>
            </form>
            <div class="context">
              <h4>StapSteen VZW</h4>
              <p>
                Chrysantenstraat 33 <br />
                1020 Laken <br />
                <i>info@stapsteen.be</i><br />
              </p>

              <h5>Miet Demaerel-Vanbeckevoort</h5>
              <p>
                Coordonnateur StapSteen. <br />
                Contactez également pour: la bibliothèque de jeux, <br />
                StapSteen kids, l’équipe de garde d’enfants Biejoeke <br />
                et les projets. <br />
                Disponible les lundis, mardis et jeudis.
              </p>

              <p>0487/95 08 69</p>
              <i>miet@stapsteen.be</i><br />

              <h5>Lisette Hendriksen</h5>
              <p>
                Contactez pour l’équipe de visite et l’équipe des volontaires.
                <br />
                Disponible les mardis, mercredis et jeudis.
              </p>
              <p>0471/86 01 23</p>
              <i>lisette@stapsteen.be</i><br />
            </div>
          </div>

          <a
            class="facebook"
            href="https://www.facebook.com/StapsteenVzw"
            target="_blank"
            >Facebook</a
          >
        </section>

        <img
          class="grootfoto"
          src="img/photo-1534982841079-afde227ada8f.jpg"
          alt=""
        />

        <section id="donatie">
          <div class="titels">
            <p class="bezoek">Une gentille contribution</p>
            <h2 class="wzw">faire un don</h2>
          </div>

          <div class="doneren">
            <div class="textdon">
              <p>
                Avec votre contribution, vous donnez à notre équipe une plus
                <b>grande chance</b> de mieux soutenir les parents.
              </p>

              <div class="donate">
                <div class="donate-buttons">
                  <input type="radio" id="1€" name="donate" value="1" />
                  <label for="1€">1€</label><br />
                  <input type="radio" id="10€" name="donate" value="10" />
                  <label for="10€">10€</label><br />
                  <input type="radio" id="20€" name="donate" value="20" />
                  <label for="20€">20€</label>
                  <input type="radio" id="50€" name="donate" value="50" />
                  <label for="50€">50€</label>
                </div>
                <div id="div1">
                  <input class="radiobutton-donatie" type="radio" name="donate"
                  id="donate" value="Normal Radio" checked= /><input
                    type="text"
                    class="input-donatie"
                    name="donate"
                    value=""
                    placeholder="vrije gift"
                  />
                </div>
                <a href="#">continuer</a>
              </div>
            </div>
            <img
              class="tana"
              src="img/tanaphong-toochinda-GagC07wVvck-unsplash2.jpg"
              alt=""
            />
          </div>
        </section>
      </section>
    </main>

    <footer>
      <section class="foter">
        <div class="adres">
          <p>
            Stapsteen (NPO) <br />
            33, Chrysantenstraat <br />
            B-1020 Laken (Brussels, Belgium) <br />
          </p>
          <p>IBAN BE21 6528 1576 2103</p>
        </div>
        <div class="sponsor">
          <p>Accredited and subsidized by:</p>
          <img src="img/kbs_logo.svg" alt="" />
          <img src="img/logo-Kind-en-Gezin.png" alt="" />
          <p>Sponsored by:</p>
          <img src="img/skryvLogo.svg" alt="" />
        </div>
      </section>
    </footer>
  </body>
</html>
