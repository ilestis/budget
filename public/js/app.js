$(function() {
    $("input[data-type='datepicker']").datepicker({ dateFormat: 'yy-mm-dd' });

    dashboardExpenseModal = $('#dashboard-expense-modal');
    if (dashboardExpenseModal.length) {
        dashboardExpenseModal.modal({
            show: false
        });

        $('button[name="dashboard-add-expense"]').each(function() {
            budgetId = $(this).attr('data-budget-id');
            budgetName = $(this).attr('data-budget-name');

            if (budgetId && budgetName) {
                $(this).click(function() {
                    budgetId = $(this).attr('data-budget-id');
                    budgetName = $(this).attr('data-budget-name');

                    dashboardExpenseModal.find('.modal-title').text(budgetName);
                    dashboardExpenseModal.find('input[name="budget_id"]').val(budgetId);
                    dashboardExpenseModal.modal('show');
                })
            }
        });
    }
    

});