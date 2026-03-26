<?php

namespace ServerDev\NodeIcon\XF\Entity;

class Node extends XFCP_Node
{
	public function isCustomNode()
	{
		return $this->node_icon_type!='default' && !empty($this->node_icon);
	}

	public function isCustomUnreadNode()
	{
		return $this->node_icon_type!='default' && !empty($this->node_icon_unread);
	}
}