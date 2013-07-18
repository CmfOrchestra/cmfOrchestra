

    /**
     * Template : Finds and displays a list of {{ entity }} entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_listAction($category = '', $MaxResults = null, $template = '_tmp_list.html.twig', $order = 'DESC', $lang = "")
    {
        $em         = $this->getDoctrine()->getEntityManager();

        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
            
        $query        = $em->getRepository("{{ bundle }}:{{ entity }}")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("{{ bundle }}:{{ entity }}")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("{{ bundle }}:{{ entity }}:$template", array(
            'entities' => $entities,
            'cat'       => ucfirst($category),
            'locale'   => $lang,
        ));
    } 