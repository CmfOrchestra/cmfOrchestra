

	/**
     * Change the position of a {{ entity }} entity.
     *
     * @Route("/admin/gedmo/{{ entity|lower|replace({"\\": ''}) }}/position", name="admin_gedmo_{{ entity|lower|replace({"\\": '_'}) }}_position_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function positionajaxAction()
    {
    	return parent::positionajaxAction();
    }   