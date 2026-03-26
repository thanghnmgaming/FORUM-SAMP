<?php
// FROM HASH: 98ba474b5e05922f32ae6919ebb52c3d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->isTraversable($__vars['displayStyles'])) {
		foreach ($__vars['displayStyles'] AS $__vars['id'] => $__vars['style']) {
			if ($__vars['style']['username_css']) {
				$__finalCompiled .= '
	.username--style' . $__templater->escape($__vars['id']) . '
	{
		' . $__templater->filter($__vars['style']['username_css'], array(array('raw', array()),), true) . '
	}
';
			}
		}
	}
	$__finalCompiled .= '

.m-usernameIcon()
{
	.m-faBase();
	margin-left: .33em;
	font-size: smaller;
}

.username--invisible
{
	color: @xf-textColorMuted;

	/*&:after {
		.m-usernameIcon();
		.m-faContent(@fa-var-eye-slash);
	}*/
}

.username--banned
{
	text-decoration: line-through;

	&:after {
		.m-usernameIcon();
		.m-faContent(@fa-var-ban);
	}
}

/* ký tự trước username */
.username--style8:before {
color: white ;
content: "[SD]";
}
.username--style4:before {
color: white;
content: "[AD]";
}
.username--style7:before {
color: white;
content: "[GL]";
}
.username--style6:before {
color: white;
content: "[GO]";
}
.username--style5:before {
color: #FFCC66;
content: "[GM]";
}
.username--style9:before {
color: #2BB9FF;
content: "[T-CTV]";
}
.username--style11:before {
color: white;
content: "[GD]";
}
.username--style13:before {
color: #2BB9FF;
content: "[CTV]";
}
.username--style20:before {
color:  #99CC00;
content: "[OS]";
}
.username--style23:before {
color:  #FFA500;
content: "[VIP]";
}
.username--style24:before {
color: #059C3A;
content: "[GM]";
}';
	return $__finalCompiled;
});