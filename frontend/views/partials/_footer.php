<?php
use common\helpers\Html;

/**
 * Created by dinhty.luu@gmail.com
 * Date: 06/12/2016
 * Time: 15:42
 */
?>
<footer class="footer " role="contentinfo">
    <div class="container">
        <div class="footer__row">
            <section class="footer__module footer__module--centered">
                <?= Html::a(Html::img(\yii\helpers\Url::home(true) . 'images/logo.png'), \yii\helpers\Url::home(true)) ?>
            </section>
            <section class="footer__module">
                <h3 class="footer__title">About my shop</h3>
                <p>This is a description about your shop. You can change it in the theme settings.</p>
            </section>
            <section class="footer__module">
                <h3 class="footer__title">More links</h3>
                <ul class="footer__linklist list--unstyled">
                    <li>
                        <a>Search</a>
                    </li>
                    <li>
                        <a>About Us</a>
                    </li>
                    <li>
                        <a>Documentation</a>
                    </li>
                </ul>
            </section>
        </div>
        <div class="footer__row">
            <section class="footer__module footer-social">
                <h3 class="footer__title">Follow us</h3>
            </section>
            <section class="footer__module">
                <h3 class="footer__title">Contact us</h3>
                <p>Call Us at (333) 123 456</p>
                <p>
                    <a href="mailto:john@doe.com">john@doe.com</a>
                </p>
            </section>
        </div>
        <div class="footer__misc">
            <p class="footer__copyright">
                <?= Html::a('CO.kool', \yii\helpers\Url::home(true)) ?>
                /
                <?= Html::a('Powered by CO.kool', \yii\helpers\Url::home(true)) ?>

            </p>
            <ul class="payment-methods list--unstyled">
            </ul>
        </div>
    </div>
</footer>
