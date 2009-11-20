		<div id="footer">
			<div id="footer_left">
                <?$b = Benchmark::get('system_benchmark_total_execution')?>
                <span style="font-size:9px">
                    This page is generated in <strong><?=number_format($b['time'],3)?></strong>s using <strong><?=number_format($b['memory']/(1024*1024),2)?></strong>MB memory
                </span>
			</div>
			<div id="footer_right">
				<span>&copy; Garut Crew</span>
			</div>
		</div>
	</div>
</body>
</html>
<?//$this->profiler = new Profiler();?>
<?if(false):?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7168160-4");
pageTracker._trackPageview();
} catch(err) {}</script>
<?endif;?>
