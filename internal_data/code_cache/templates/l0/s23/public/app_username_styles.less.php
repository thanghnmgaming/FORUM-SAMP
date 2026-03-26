<?php
// FROM HASH: 6ac26cebd061c5b29d1d263881fcafa0
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

	&:after {
		.m-usernameIcon();
		.m-faContent(@fa-var-eye-slash);
	}
}

.username--banned
{
	text-decoration: line-through;

	&:after {
		.m-usernameIcon();
		.m-faContent(@fa-var-ban);
	}
}


.username--staff:after
{
	.m-usernameIcon();
	.m-faContent(@fa-var-address-card-o);
}

.username--moderator:after
{
	.m-usernameIcon();
	.m-faContent(@fa-var-shield);
}

.username--admin:after
{
	.m-usernameIcon();
	.m-faContent(@fa-var-id-badge);
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
color: #CC0000;
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
}/* ký tự trước username */
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
color: #CC0000;
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
}';
	return $__finalCompiled;
});