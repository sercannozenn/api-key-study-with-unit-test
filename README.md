## Integration Key Study / Service Pattern - Unit Test

- <u><b>Kurulum Adımları</b></u>
<ol start="1">
<li><b>composer install</b> komutunu çalıştırın.</li>
<li><b>.env</b> dosyasını oluşturun. (.env.example dosyasını çoğaltabilirsiniz.)</li>
<li><b>php artisan key:generate</b> komutunu çalıştırın.</li>
<li>Bir veritabanı oluşturun.</li>
<li><b>.env</b> veritabanı konfigürasyonunu yapın.</li>
<li><b>php artisan migrate ve php artisan db:seed</b> </li>
<li><b> Veritabanını projenin yolunda bulunan api_key_study.sql dosyasını import ederekte kullanabilirsiniz.</b></li>
<li>Unit Test için aynı database kullanılması önerilmez. Bu yüzden farklı bir veritabanı oluşturulmalıdır. phpunit.xml dosyasında da belittiğim aynı adı kullanabilirsiniz.  <b>api_test</b> adında bir veritabanı oluşturulmalı. <b>api_key_study.sql</b> dosyasını import etmeniz yeterli olacaktır. </li>
<li><b>php artisan passport:install</b> komutunu çalıştırın.</li>
</ol>