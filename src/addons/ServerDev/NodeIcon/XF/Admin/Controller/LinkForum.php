<?php

namespace ServerDev\NodeIcon\XF\Admin\Controller;

class LinkForum extends XFCP_LinkForum
{
	protected function saveTypeDataNodeiconExtend(\XF\Mvc\FormAction $form, \XF\Entity\Node $node, \XF\Entity\AbstractNode $data)
	{
		$form->setup(function() use ($node)
		{
			$input = $this->filter([
				'node' => [
					'node_icon' => 'str',
					'node_icon_unread' => 'str',
					'node_icon_type' => 'str'
				]
			]);

			$node->node_icon = $input['node']['node_icon'];
			$node->node_icon_unread = $input['node']['node_icon_unread'];
			$node->node_icon_type = $input['node']['node_icon_type'];	    
		});
	}

	protected function saveTypeData(\XF\Mvc\FormAction $form, \XF\Entity\Node $node, \XF\Entity\AbstractNode $data)
	{
		parent::saveTypeData($form, $node, $data);
		$this->saveTypeDataNodeiconExtend($form, $node, $data);
	}
}