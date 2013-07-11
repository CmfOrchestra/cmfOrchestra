

    /**
     * Delete a {{ entity }} entity.
     *
     * @Route("/admin/gedmo/{{ entity|lower|replace({"\\": ''}) }}/delete", name="admin_gedmo_{{ entity|lower|replace({"\\": '_'}) }}_deletentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deleteajaxAction()
    {
        return parent::deletajaxAction();
    }   