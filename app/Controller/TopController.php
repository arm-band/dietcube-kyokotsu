<?php
/**
 *
 */

namespace DietcubeKyokotsu\Controller;

use Dietcube\Controller;

class TopController extends Controller
{
    public function index()
    {
        $sample_service = $this->get('service.sample');

        return $this->render('index', [
            'sample_hello'    => $sample_service->sayHello(),
            'sample_kyokotsu' => $sample_service->sayKyokotsu(),
            'sample_ichu'     => getenv('ICHU'),
        ]);
    }
}
