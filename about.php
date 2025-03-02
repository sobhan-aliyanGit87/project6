<?php
include("vazyat.php");
?>

<section class="about-us">
    <!-- بخش عکس که بالای صفحه را اشغال می‌کند -->
    <div class="about-image parallax">
        <img src="mohit1.jpg" alt="درباره ما" class="img-fluid fade-in">
        <div class="overlay zoom-in">
            <div class="overlay-text slide-up">
                <p>تولیدکننده خوراک دامی با بالاترین کیفیت در صنعت</p>
            </div>
        </div>
    </div>

    <!-- متن پایین عکس -->
    <div class="about-description slide-up-fade">
        <h3 class="about-title">کیفیت بی‌نظیر در صنعت خوراک دامی</h3>
        <h4 class="about-subtitle">چرا انتخاب کیا فرایند نوتریکا؟</h4>
        <div class="about-text">
            <p>شرکت کیا فرآیند نوتریکا یک واحد تولیدی مدرن و نوآور در صنعت خوراک دام و طیور است که با بیش از نیم قرن تجربه در این حوزه، در تلاش است تا محصولات با بالاترین کیفیت را به مشتریان خود ارائه دهد.</p>
            <p>این شرکت با هدف تکمیل زنجیره تولیدی خود و تأمین نیاز مشتریان، در سال 1401 اقدام به تأسیس واحد تولید افزودنی‌های خوراک دام و طیور کرده است. این اقدام در راستای افزایش بهره‌وری و تأمین نیازهای روزافزون صنعت دام و طیور کشور است.</p>
            <p>هدف غایی این مجموعه، ارائه محصولات با کیفیت بالا به همراه خدمات مطلوب برای مشتریان محترم است. ما به عنوان یکی از پیشگامان صنعت، همواره در تلاش برای نوآوری و بهبود کیفیت محصولات خود هستیم.</p>
            <p>ما به روزترین فناوری‌ها و تکنیک‌های تولید را برای بهبود محصولات خود به کار می‌بریم و همواره در راستای ارتقای کیفیت و رعایت استانداردهای بین‌المللی در تلاش هستیم.</p>
            <p>برای کسب اطلاعات بیشتر و مشاوره، لطفاً با تیم پشتیبانی ما تماس بگیرید. ما آماده‌ایم تا به شما خدمات با کیفیتی ارائه دهیم.</p>
        </div>
    </div>
</section>

<?php
include("footer.html");
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
        overflow-x: hidden;
    }

    /* بخش عکس و پارالاکس */
    .about-image {
        position: relative;
        width: 100%;
        height: 60vh;
        overflow: hidden;
        animation: slideIn 2s ease-out;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        animation: fadeIn 2s ease-in-out;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        animation: overlayIn 2s ease-in-out forwards;
    }

    .overlay-text {
        color: #fff;
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
        padding: 20px;
        opacity: 0;
        animation: textAppear 2s forwards 0.5s;
    }

    /* بخش توضیحات */
    .about-description {
        padding: 60px;
        background-color: #fff;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        margin-top: -40px;
        opacity: 0;
        transform: translateY(40px);
        animation: slideUpFade 2s forwards 0.5s;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    .about-title {
        font-size: 3rem;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: 2px;
        opacity: 0;
        animation: titleFadeIn 2s forwards 1s;
    }

    .about-subtitle {
        font-size: 2rem;
        color: #42a5f5;
        text-align: center;
        margin-bottom: 30px;
        opacity: 0;
        animation: subtitleFadeIn 2s forwards 1.5s;
    }

    .about-text p {
        font-size: 1.3rem;
        line-height: 1.8;
        color: #555;
        text-align: justify;
        margin-bottom: 25px;
        opacity: 0;
        animation: textFadeIn 2s forwards 2s;
    }

    /* انیمیشن‌ها */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes slideIn {
        0% { transform: translateY(100px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideUpFade {
        0% { opacity: 0; transform: translateY(50px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes overlayIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes textAppear {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes titleFadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes subtitleFadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes textFadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    /* انیمیشن پارالاکس */
    .parallax {
        background-image: url('mohit1.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        animation: parallaxEffect 2s ease-in-out;
        will-change: transform;
    }

    @keyframes parallaxEffect {
        0% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* برای موبایل‌ها */
    @media (max-width: 768px) {
        .about-title {
            font-size: 2.2rem;
        }

        .about-subtitle {
            font-size: 1.7rem;
        }

        .about-description {
            padding: 30px;
        }

        .overlay-text {
            font-size: 1.5rem;
        }
    }
</style>
<?php
include("bat.html");
?>