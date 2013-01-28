
    /**
     * Lists all {{ entity }} entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
    	$em			= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('session')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";
        
        if($NoLayout && $category && !empty($category)){
    		//$entities 	= $em->getRepository("{{ bundle }}:{{ entity }}")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("{{ bundle }}:{{ entity }}")->setContainer($this->container)->getAllByCategory($category, null, '', 'ASC', false)->getQuery();
        	$entities   = $em->getRepository("{{ bundle }}:{{ entity }}")->findTranslationsByQuery($locale, $query, 'object', false);  
    	}else
    		$entities	= $em->getRepository("{{ bundle }}:{{ entity }}")->setContainer($this->container)->findAllByEntity($locale, 'object');

{% if 'annotation' == format %}
        return array(
        	'entities'	=> $entities,
        	'NoLayout'	=> $NoLayout,
        	'category'	=> $category,
        );
{% else %}
        return $this->render("{{ bundle }}:{{ entity|replace({'\\': '/'}) }}:$template", array(
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
{% endif %}
    }
