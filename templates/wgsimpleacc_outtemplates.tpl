<{if $showList}>
	<{if $outtemplatesCount > 0}>
		<h3><{$smarty.const._MA_WGSIMPLEACC_OUTTEMPLATES_LIST}></h3>
		<div class='table-responsive'>
			<table class='table table-<{$table_type}>'>
				<thead>
				<tr class='head'>
					<th class="col-sm-8 center"><{$smarty.const._MA_WGSIMPLEACC_OUTTEMPLATE_NAME}></th>
					<th class="col-sm-1 center"><{$smarty.const._MA_WGSIMPLEACC_OUTTEMPLATE_ONLINE}></th>
					<th class="col-sm-3 center"><{$smarty.const._MA_WGSIMPLEACC_FORM_ACTION}></th>
				</tr>
				</thead>
				<tbody>
					<{foreach item=template from=$outtemplates}>
						<{include file='db:wgsimpleacc_outtemplates_list.tpl' }>
					<{/foreach}>
				</tbody>
			</table>
		</div>
	<{/if}>
<{/if}>
<{if $outputText}>
	<div class="wgsa_outtemplate"><{$outputText}></div>
<{/if}>
