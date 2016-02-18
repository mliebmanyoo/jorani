<?php 
/**
 * This view displays the list of collaborators of the connected employee.
 * e.g. users having the connected user as their line manager.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license      http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link            https://github.com/bbalet/jorani
 * @since         0.4.0
 */
?>

<div class="row-fluid">
    <div class="span12">

<h2><?php echo lang('requests_collaborators_title');?>  &nbsp;<?php echo $help;?></h2>

<?php echo $flash_partial_view;?>

<p><?php echo lang('requests_collaborators_description');?></p>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="collaborators" width="100%">
    <thead>
        <tr>
            <th><?php echo lang('requests_collaborators_thead_id');?></th>
            <th><?php echo lang('requests_collaborators_thead_firstname');?></th>
            <th><?php echo lang('requests_collaborators_thead_lastname');?></th>
            <th><?php echo lang('requests_collaborators_thead_email');?></th>
            <th><?php echo lang('requests_collaborators_thead_identifier');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($collaborators as $collaborator): ?>
        <tr>
            <td data-order="<?php echo $collaborator['id']; ?>">
                <?php echo $collaborator['id']; ?>
                <div class="pull-right">
                    <?php if ($this->config->item('requests_by_manager') == TRUE) { ?>
                    <a href="<?php echo base_url();?>requests/createleave/<?php echo $collaborator['id'] ?>" title="<?php echo lang('requests_collaborators_thead_link_create_leave');?>"><i class="icon-plus"></i></a>
                    <?php } ?>
                    <a href="<?php echo base_url();?>hr/counters/collaborators/<?php echo $collaborator['id'] ?>" title="<?php echo lang('requests_collaborators_thead_link_balance');?>"><i class="icon-info-sign"></i></a>
                    &nbsp;<a href="<?php echo base_url();?>hr/presence/collaborators/<?php echo $collaborator['id'] ?>" title="<?php echo lang('requests_collaborators_thead_link_presence');?>"><i class="fa fa-pie-chart" style="color:black;"></i></a>
                    &nbsp;<a href="<?php echo base_url();?>calendar/year/<?php echo $collaborator['id'] ?>" title="<?php echo lang('requests_collaborators_thead_link_year');?>"><i class="icon-calendar"></i></a>
                </div>
            </td>
            <td><?php echo $collaborator['firstname'] ?></td>
            <td><?php echo $collaborator['lastname'] ?></td>
            <td><a href="mailto:<?php echo $collaborator['email']; ?>"><?php echo $collaborator['email']; ?></a></td>
            <td><?php echo $collaborator['identifier'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
	</div>
</div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/datatable/buttons/css/buttons.dataTables.min.css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/colreorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#collaborators').dataTable({
            stateSave: true,
            "order": [[ 3, "asc" ], [ 2, "asc" ]],
            dom: 'Bfrtip',
            buttons: [
                            {
                                extend: 'pageLength',
                                text: '<?php echo lang('datatable_pagination');?>'
                            },
                            {
                                extend: 'colvis',
                                columns: ':not(:first-child)',
                                postfixButtons: [
                                    {
                                        extend: 'colvisRestore',
                                        text: '<?php echo lang('datatable_colvisRestore');?>'
                                    }
                                ]
                            }
            ],
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [
                    '<?php echo lang('datatable_10_rows');?>',
                    '<?php echo lang('datatable_25_rows');?>',
                    '<?php echo lang('datatable_50_rows');?>',
                    '<?php echo lang('datatable_all_rows');?>' 
                ]
            ],
            colReorder: {
                fixedColumnsLeft: 1
            },
        language: {
            buttons: {
                colvis: '<?php echo lang('datatable_colvis');?>'
            },
            decimal:            "<?php echo lang('datatable_sInfoThousands');?>",
            processing:       "<?php echo lang('datatable_sProcessing');?>",
            search:              "<?php echo lang('datatable_sSearch');?>",
            lengthMenu:     "<?php echo lang('datatable_sLengthMenu');?>",
            info:                   "<?php echo lang('datatable_sInfo');?>",
            infoEmpty:          "<?php echo lang('datatable_sInfoEmpty');?>",
            infoFiltered:       "<?php echo lang('datatable_sInfoFiltered');?>",
            infoPostFix:        "<?php echo lang('datatable_sInfoPostFix');?>",
            loadingRecords: "<?php echo lang('datatable_sLoadingRecords');?>",
            zeroRecords:    "<?php echo lang('datatable_sZeroRecords');?>",
            emptyTable:     "<?php echo lang('datatable_sEmptyTable');?>",
            paginate: {
                first:          "<?php echo lang('datatable_sFirst');?>",
                previous:   "<?php echo lang('datatable_sPrevious');?>",
                next:           "<?php echo lang('datatable_sNext');?>",
                last:           "<?php echo lang('datatable_sLast');?>"
            },
            aria: {
                sortAscending:  "<?php echo lang('datatable_sSortAscending');?>",
                sortDescending: "<?php echo lang('datatable_sSortDescending');?>"
            }
        },
    });
});
</script>
