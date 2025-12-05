<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    @font-face {
    font-family: "PlusJakartaSans";
    src: url("public/assets/Plus_Jakarta_Sans/static/PlusJakartaSans-Regular.ttf") format("truetype");
    }

    .footer-container {
        background-color: #000000;
        color: #ffffff;
        padding: 40px 20px;
        font-family: "PlusJakartaSans", sans-serif;
    }

    .footer-content {
        display: flex;
        justify-content: space-around;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
        padding-bottom: 20px;
    }

    .footer-column h3 {
        color: #ffffff;
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 1.2em;
    }

    .footer-column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-column li a {
        color: #ffffff;
        text-decoration: none;
        line-height: 1.8;
        display: block;
    }

    .footer-column li a:hover {
    text-decoration: underline;
    }

    .social-icons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .social-link{
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items:center;
        border-radius:6px;
        color:#ffffff;
        text-decoration:none;
    }

    .social-link i {
        -webkit-font-smoothing: antialiased; 
        -moz-osx-font-smoothing: grayscale;
        transform: translateZ(0);
    }

    .social-link.instagram { background-color: #E4405F; }
    .social-link.youtube { background-color: #FF0000; }
    .social-link.linkedin { background-color: #0077B5; }
    .social-link.facebook { background-color: #3B5998; }

    .separator {
        border-top: 1px solid #ffffff;
        width: 100px;
        margin-top: 10px;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #333333; 
    }

    .footer-bottom h4 {
        color: #ffffff;
        margin-bottom: 5px;
        font-size: 1.1em;
    }

    .footer-bottom p {
        font-size: 0.9em;
        color: #aaaaaa;
    }

    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .footer-column {
            min-width: 100%;
            margin: 0 0 20px 0;
        }
        .social-icons {
            justify-content: center;
        }
        .separator {
            margin: 10px auto; /* Tengahkan separator */
        }
    }
</style>
    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">How to Buy</a></li>
                    <li><a href="#">How to Sell</a></li>
                    <li><a href="#">Private Service</a></li>
                    <li><a href="#">Professional & Advicor Service</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Private Police</h3>
                <ul>
                    <li><a href="#">Private Police</a></li>
                    <li><a href="#">Cookie Police</a></li>
                    <li><a href="#">Modern Slavery/Police</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Never Miss a Moments</h3>
                <p>Subscribe to Our Newsletter</p>
            
                <div class="social-icons">
                    <a href="#" class="social-link instagram"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="social-link youtube"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#" class="social-link linkedin"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    <a href="#" class="social-link facebook"><i class="fab fa-facebook-f fa-lg"></i></a>
                </div>
                <div class="separator"></div>
            </div>
        </div>

        <div class="footer-bottom">
            <h4>Encheres</h4>
            <p>@Encheres Auctioneers, LLC</p>
        </div>
    </footer>
