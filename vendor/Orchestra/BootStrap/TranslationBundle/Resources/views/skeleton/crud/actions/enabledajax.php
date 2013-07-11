

    /**
     * Enabled {{ entity }} entities.
     *
     * @Route("/admin/gedmo/{{ entity|lower|replace({"\\": ''}) }}/enabled", name="admin_gedmo_{{ entity|lower|replace({"\\": '_'}) }}_enabledentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function enabledajaxAction()
    {
        return parent::enabledajaxAction();
    }