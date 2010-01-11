--TEST--
Test for bug #515: Dead Code Analysis for code coverage messed up with ticks.
--SKIPIF--
<?php if (!extension_loaded("xdebug")) print "skip"; ?>
--INI--
xdebug.default_enable=1
xdebug.auto_trace=0
xdebug.trace_options=0
xdebug.trace_output_dir=/tmp
xdebug.collect_params=1
xdebug.collect_return=0
xdebug.collect_assignments=0
xdebug.auto_profile=0
xdebug.profiler_enable=0
xdebug.dump_globals=0
xdebug.show_mem_delta=0
xdebug.trace_format=0
xdebug.extended_info=1
--FILE--
<?php
	xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);

	include 'bug00515.inc';
	$cc = xdebug_get_code_coverage();
	array_shift($cc);
	var_dump($cc);

	xdebug_stop_code_coverage(false);
?>
--EXPECTF--
array(1) {
  ["%sbug00515.inc"]=>
  array(11) {
    [2]=>
    int(1)
    [4]=>
    int(1)
    [9]=>
    int(-1)
    [10]=>
    int(-1)
    [11]=>
    int(-1)
    [12]=>
    int(-1)
    [14]=>
    int(-1)
    [18]=>
    int(-1)
    [19]=>
    int(-2)
    [21]=>
    int(1)
    [22]=>
    int(1)
  }
}
