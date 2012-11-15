
    /**
     * Lists all {{ entity }} entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
    	$em			= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('session')->getLocale();
        $entities	= $em->getRepository("{{ bundle }}:{{ entity }}")->findAllByEntity($locale, 'object');        
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";

{% if 'annotation' == format %}
        return array(
        	'entities' => $entities,
        	'NoLayout'	=> $NoLayout,
        );
{% else %}
        return $this->render("{{ bundle }}:{{ entity|replace({'\\': '/'}) }}:$template", array(
            'entities' => $entities,
            'NoLayout'	=> $NoLayout,
        ));
{% endif %}
    }
