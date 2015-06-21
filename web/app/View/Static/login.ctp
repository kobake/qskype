<div class="users form" style="width: 800px;">
	<div class="well form-horizontal"><!-- form --><!-- action="/basis" class="well form-horizontal" id="UserLoginForm" method="get" accept-charset="utf-8"> -->
		<div style="display:none;">
			<input type="hidden" name="_method" value="PUT">
		</div>
		<fieldset>
			<legend>ログイン（見た目だけ）</legend>
			<input type="hidden" name="data[User][id]" class="form-control" value="1" id="UserId">
			<div class="form-group required">
				<label for="UserName" class="col col-md-3 col-xs-3 control-label">ユーザ名</label>
				<div class="col col-md-5 col-xs-5 required">
					<input name="data[User][name]" class="form-control" type="text" value="aaaaa" id="UserName" required="required">
				</div>
			</div>
			<div class="form-group required">
				<label for="UserName" class="col col-md-3 col-xs-3 control-label">パスワード</label>
				<div class="col col-md-5 col-xs-5 required">
					<input name="data[User][name]" class="form-control" type="password" value="bbbbb" id="UserPassword" required="required">
				</div>
			</div>
		</fieldset>
		<div class="form-group">
			<div class="col col-md-5 col-xs-5 col-md-offset-3 col-xs-offset-3">
				<input class="btn btn-default" type="submit" value="ログイン" onclick="javascript:location.href='/basis';">
			</div>
		</div>
	</dif> <!-- /form -->
</div>
