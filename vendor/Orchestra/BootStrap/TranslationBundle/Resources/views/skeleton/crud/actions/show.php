
    /**
     * Finds and displays a {{ entity }} entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em         = $this->getDoctrine()->getEntityManager();
        $locale        = $this->container->get('request')->getLocale();
        $entity     = $em->getRepository("{{ bundle }}:{{ entity }}")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('{{ entity }}');
        }
{% if 'delete' in actions %}

        $deleteForm = $this->createDeleteForm($id);
{% endif %}

{% if 'annotation' == format %}
        return array(
            'entity'        => $entity,
            'NoLayout'        => $NoLayout,
            'category'        => $category,
{% if 'delete' in actions %}
            'delete_form'    => $deleteForm->createView(),
{%- endif %}
        );
{% else %}
        return $this->render("{{ bundle }}:{{ entity|replace({'\\': '/'}) }}:$template", array(
            'entity'      => $entity,
            'NoLayout'      => $NoLayout,
            'category'      => $category,
{% if 'delete' in actions %}
            'delete_form' => $deleteForm->createView(),
{% endif %}
        ));
{% endif %}
    }
