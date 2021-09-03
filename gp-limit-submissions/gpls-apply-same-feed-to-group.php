<?php
/**
 * Gravity Perks // GP Limit Submissions // Apply Limit Feed to Group of Forms
 * https://gravitywiz.com/documentation/gravity-forms-limit-submissions/
 *
 * Apply the same Limit Feed to a group of forms, but each form's limit is applied per form.
 *
 * Plugin Name:  GP Limit Submissions  — Apply Limit Feed to Group of Forms
 * Plugin URI:   https://gravitywiz.com/documentation/gravity-forms-limit-submissions/
 * Description:  Apply the same Limit Feed to a group of forms, but each form's limit is applied per form.
 * Author:       Gravity Wiz
 * Version:      0.1
 * Author URI:   https://gravitywiz.com/
 */
add_filter( 'gpls_rule_groups', function( $rule_groups, $form_id ) {

	// Update "123" to the ID of your form.
	$primary_form_id = 123;

	if( $form_id == $primary_form_id || ! in_array( $form_id, array( 124, 125, 126 ) ) ) {
		return $rule_groups;
	}

	$rule_groups = array_merge( $rule_groups, GPLS_RuleGroup::load_by_form( $primary_form_id ) );
	foreach( $rule_groups as $rule_group ) {
		$rule_group->applicable_forms = false;
	}

	return $rule_groups;
}, 10, 2 );