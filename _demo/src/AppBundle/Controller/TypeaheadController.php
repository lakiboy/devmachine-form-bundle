<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\TypeaheadLanguageType;
use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadCountryType;
use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadTimezoneType;
use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class TypeaheadController extends Controller
{
    use ServicesTrait;

    /**
     * @Route("/", name="typeahead")
     * @Template("AppBundle::typeahead.html.twig")
     */
    public function indexAction()
    {
        return [
            'language' => $this->languageForm()->createView(),
            'airport'  => $this->airportForm()->createView(),
            'ajax'     => $this->ajaxForm()->createView(),
            'country'  => $this->countryForm()->createView(),
            'timezone' => $this->timezoneForm()->createView(),
            'title'    => 'Typeahead',
            'nav'      => 'typeahead',
        ];
    }

    /**
     * @Route("/search", name="typeahead_search", methods="get", condition="request.isXmlHttpRequest()")
     */
    public function searchAction(Request $request)
    {
        $query = strtolower($request->query->get('query'));

        $data = [];
        if (strlen($query) < 2) {
            return JsonResponse::create($data);
        }

        // Do the search, could be a database call.
        // Ensure keys are set according to form type.
        foreach (Intl::getLanguageBundle()->getLanguageNames() as $key => $val) {
            if (strpos(strtolower($val), $query) === 0) {
                $data[] = ['key' => $key, 'val' => $val];
            }
        }

        return JsonResponse::create($data);
    }

    private function languageForm()
    {
        return $this->createNamedBuilder('language')
            ->add('language', TypeaheadType::class, [
                'label'       => 'Programming language',
                'source_name' => 'languages',
                'min_length'  => 1,
                'placeholder' => 'Start typing',
                'matcher'     => 'starts_with', // ends_with, contains
                'source'      => [
                    'PHP', 'Ruby', 'Python', 'Go', 'Java', 'C', 'C++',
                    'Javascript', 'ML', 'Racket', 'Lisp', 'Pascal',
                ],
            ])
            ->getForm()
        ;
    }

    private function airportForm()
    {
        return $this->createNamedBuilder('airport')
            ->add('airport', TypeaheadType::class, [
                'source_name' => 'airports',
                'min_length'  => 2,
                'highlight'   => false, // Do not highlight current text
                'hint'        => false, // Do not show completion suggestion
                'label_key'   => 'city',
                'value_key'   => 'code',
                'source' => [
                    ['code' => 'RIX', 'city' => 'Riga', 'country' => 'LV'],
                    ['code' => 'LGW', 'city' => 'Gatwick', 'country' => 'UK'],
                    ['code' => 'STN', 'city' => 'Stansted', 'country' => 'UK'],
                    ['code' => 'LHR', 'city' => 'Heathrow', 'country' => 'UK'],
                ],
            ])
            ->getForm()
        ;
    }

    private function ajaxForm()
    {
        return $this->createNamedBuilder('ajax')
            ->add('language', TypeaheadLanguageType::class)
            ->getForm()
        ;
    }

    private function countryForm()
    {
        return $this->createNamedBuilder('country')
            ->add('country', TypeaheadCountryType::class)
            ->getForm()
        ;
    }

    private function timezoneForm()
    {
        return $this->createNamedBuilder('timezone')
            ->add('timezone', TypeaheadTimezoneType::class)
            ->getForm()
        ;
    }
}
