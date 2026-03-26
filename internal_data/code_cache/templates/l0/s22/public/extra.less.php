<?php
// FROM HASH: cb2f475eb4ddc8e079b3515a6ac7e65e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.itemList-itemOverlayTop { z-index: @zIndex-2; }
.js-visitorMenuBody
{
	.menu-row
	{
		padding: @xf-paddingLargest;
		background: @xf-paletteColor3;
	}
}

/* Sidebar */

.block[data-widget-definition="visitor_panel"]
{
	.block-container {
		background: @xf-paletteAccent3;
	}
	
	.avatar.avatar--m {
		.m-avatarSize(84px);
	}
	
	.contentRow-main:before {
		display: none;
	}
	
	.contentRow-header
	{
		font-size: @xf-fontSizeSmall;
		
		.username {
			color: @xf-paletteNeutral1;
		}
	}
	
	.contentRow-lesser {
		display: none;
	}
	
	.contentRow-minor
	{
		margin-top: 7px;
		margin-bottom: -7px;
		
		.pairs {
			line-height: 20px;
		}
	} 
}

.block[data-widget-section="staffMembers"]
{
	.avatar.avatar--xs {
		.m-avatarSize(40px);
	}
	
	.contentRow {
		align-items: center;
	}
	
	.contentRow-main .username {
		font-weight: @xf-fontWeightHeavy;
	}
}

.block[data-widget-definition="forum_statistics"]
{
	.block-row
	{
		padding-top: 5px;
		padding-bottom: 5px;
	}
	
	.pairs
	{
		> dt, > dd
		{
			color: @xf-textColor;
		}
		
		font-size: @xf-fontSizeSmaller;
		line-height: 18px;
	}
}

/* Sidebar -- End */

/* Form-row */

.formButtonGroup
{
	justify-content: center;
	
	.button { margin-right: 15px; margin-bottom: 5px; }
	
	.formButtonGroup-primary,
	.formButtonGroup-extra
	{
		display: flex;
		margin-bottom: 0;
		margin-left: 0;
		flex-direction: column;
		justify-content: center;
		flex-flow: row wrap;
	}
}

dd.formButtonGroup
{
	.button { margin-right: 10px; }
}

.formSubmitRow-controls
{
	padding-bottom: 0;
	
	.button
	{
		margin-bottom: 5px;
		margin-right: 10px;
	}
}

/* Form-row -- End */

////////////////////////////////////// START - Group Banner/Badge CSS ////////////////////////////////////

/* Adds userBanner to memberHeader-banners and memberTooltip-banners */
.userBanner.myBadge{
     background-image: url(\'images/123.png\');
     display: block;
     background-size: 75px; // adjusts size of background image
     background-position: -1.5% 0%; // adjusts image position (x% y%)
     background-repeat: no-repeat;  // keeps image from repeating
     text-indent: -7px;  // shifts text left or right
     padding-top: 25px;  // adjusts distance from image to text (group name)
     text-align: left;
	 padding-left: 35px;  
	 
	
}

/* Additonal adjustments for message-userBanner Only */
.userBanner.myBadge.message-userBanner {
     background-position: 50% 0%; // adjusts image position (x% y%)
     text-indent: 0px;  // shifts text left or right
     text-align: center;
}

/* Adjusts size, position, or removal of banner image in Mobile view */
@media (max-width: 650px){
.userBanner.myBadge.message-userBanner.userBanner {
  // background-image: none; // *** to remove background image remove "//" in front of code ***
     display: inline-block;
     background-size: 35px; // adjusts size of background image
     background-position: 0% 0%; // adjusts image position (x% y%)
     text-indent: -7px;  // shifts text left or right
     padding-top: 37px;  // adjusts distance from image to text (use with image)
  // padding-top: 0px;  // if background-image is set to "none", remove "//" and remove line above)
     text-align: left;
	
}

///////////////////////////////////// End - Group Banner/Badge CSS /////////////////////////////////
/***** YHBS Forum Statistics *****/
.YHBS_forumList_block
{
    margin-bottom: 15px;
  
    .YHBS_block_wrapper
    {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
      
        .block
        {
            width: ~"calc(50% - 10px)";
            margin-bottom: 10px;
          
            .block-container
            {
                box-shadow: none;
                overflow: hidden;
                margin-left: auto;
                margin-right: auto;
                height: 100%;
              
                .listHeap
                {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    margin: 0 auto;
                  
                    > li
                    {
                        margin-left: 5px;
                        margin-right: 5px;
                        margin-top: 10px;
                    }
                }
              
                .block-minorHeader
                {
                    background-color: @xf-paletteColor4;
                    color: @xf-paletteNeutral1;
                }
              
                .contentRow
                {
                    align-items: center;
                  
                    .contentRow-main
                    {
                        > a
                        {
                            display: block;
                            max-width: 100%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            text-decoration: none;
                            white-space: nowrap;
                            font-size: 100%;
                        }
                  
                        .contentRow-minor
                        {
                            display: none;
                        }
                    }
                }
            }
        }
    }
}

@media (max-width: 600px)
{
    .YHBS_forumList_block .YHBS_block_wrapper .block
    {
        width: 100%;
    }
}
/***** YHBS Forum Statistics *****/';
	return $__finalCompiled;
});