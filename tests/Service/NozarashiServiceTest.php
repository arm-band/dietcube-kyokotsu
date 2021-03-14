<?php

namespace DietcubeKyokotsu\Service;

class NozarashiServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testKusouzuAndroidChrome()
    {
        $nozarashi_service = new NozarashiService();

        $ua = 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.186 Mobile Safari/537.36';

        $this->assertEquals(
            true,
            $nozarashi_service->kusouzu($ua)
        );
    }
    public function testKusouzuIphoneSafari()
    {
        $nozarashi_service = new NozarashiService();

        $ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1';

        $this->assertEquals(
            true,
            $nozarashi_service->kusouzu($ua)
        );
    }
    public function testKusouzuWindowsFirefox()
    {
        $nozarashi_service = new NozarashiService();

        $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:70.0) Gecko/20100101 Firefox/70.0';

        $this->assertEquals(
            true,
            $nozarashi_service->kusouzu($ua)
        );
    }
    public function testKusouzuWindowsChromiumEdge()
    {
        $nozarashi_service = new NozarashiService();

        $ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.186 Safari/537.36 Edg/88.0.100.0';

        $this->assertEquals(
            true,
            $nozarashi_service->kusouzu($ua)
        );
    }
    public function testKusouzuWindowsIE()
    {
        $nozarashi_service = new NozarashiService();

        $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko';

        $this->assertEquals(
            false,
            $nozarashi_service->kusouzu($ua)
        );
    }
}
