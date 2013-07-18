

    /**
     * Template : Finds and displays a {{ entity }} entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_showAction($id, $template = '_tmp_show.html.twig', $lang = "")
    {
        $em     = $this->getDoctrine()->getEntityManager();
        
        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
            
        $entity = $em->getRepository("{{ bundle }}:{{ entity }}")->findOneByEntity($lang, $id, 'object', false);
        
        if (!$entity) {
            throw ControllerException::NotFoundException('{{ entity }}');
        }
        
        if (method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
            $template = $entity->getTemplate();         
    
        return $this->render("{{ bundle }}:{{ entity }}:$template", array(
                'entity'    => $entity,
                'locale'    => $lang,
        ));
    }