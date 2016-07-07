<?php
/* ----------------------------------------------------------------------
 * app/widgets/notifications/views/main_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2016 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */

	/** @var RequestHTTP $po_request */
 	$po_request				= $this->getVar('request');
	$va_settings 			= $this->getVar('settings');
	$vs_widget_id 			= $this->getVar('widget_id');
	$va_notification_list	= $this->getVar('notification_list');
?>

<div class="dashboardWidgetContentContainer dashboardWidgetScrollMedium">
	<table class='dashboardWidgetTable'>
		<tr>
			<th>&nbsp;</th>
			<th><?php print _t('Date/time');?></th>
			<th><?php print _t('Message');?></th>
		</tr>
			
<?php
	foreach($va_notification_list as $vn_notification_id => $va_notification) {
		$vs_short_message = caTruncateStringWithEllipsis($va_notification['message'], 50);
		if(strlen($va_notification['message']) != strlen($vs_short_message)) {
			TooltipManager::add('#notificationWidgetMessage'.$vn_notification_id, $va_notification['message']);
		}

		print "<tr>";
		print "<td><a href='#' onclick='caMarkNotificationAsRead(".$va_notification['subject_id'].", ".$vn_notification_id."); return false;'>"._t("Read")."</a></td>";
		print "<td>".date("n/d/y, g:iA", $va_notification['datetime'])."</td>";
		print "<td id='notificationWidgetMessage{$vn_notification_id}'>".$vs_short_message."</td>";
		print "</tr>\n";
	}
?>
	</table>
</div>

<script type="text/javascript">
	function caMarkNotificationAsRead(subject_id, notification_id) {
		jQuery.get("<?php print caNavUrl($po_request, 'manage', 'Notifications', 'markAsRead')?>", { subject_id: subject_id });
		jQuery('#notificationWidgetMessage' + notification_id).parent().hide();
	}
</script>
