
    /**
     * Displays a form to create a new {{ entity }} entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
    	$em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('session')->getLocale();
    	$entity = new {{ entity_class }}();
        $form   = $this->createForm(new {{ entity_class }}Type($em, $locale), $entity, array('show_legend' => false));
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";        

{% if 'annotation' == format %}
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        );
{% else %}
        return $this->render("{{ bundle }}:{{ entity|replace({'\\': '/'}) }}:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        ));
{% endif %}
    }
