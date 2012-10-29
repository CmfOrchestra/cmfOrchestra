

    /**
     * Disable {{ entity }} entities.
     * 
     * @Route("/admin/gedmo/{{ entity|lower|replace({"\\": ''}) }}/disable", name="admin_gedmo_{{ entity|lower|replace({"\\": '_'}) }}_disablentity_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function disableajaxAction()
    {
		return parent::disableajaxAction();
    } 