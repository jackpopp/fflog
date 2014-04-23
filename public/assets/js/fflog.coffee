showSection = (target) ->
	$('.js-show-section').each -> $(@).removeClass('active')
	target.addClass('active')
	if target.hasClass('js-new-post-a')
		$('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeIn(400, $('.js-focus-input').focus())))

	if target.hasClass('js-blog-settings-a')
		$('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeIn()))

	if target.hasClass('js-edit-posts-a')
		$('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeIn(400, -> $('.js-blog-name').focus())))
	return

$ ->
	$('body').addClass('invisible')
	setTimeout(
		-> $('body').removeClass('invisible')
		50
	)
	$('textarea').css('overflow', 'hidden').autosize()
	$('.js-focus-input').focus()
	$('.js-show-section').click (e) ->
		showSection($(e.target))
		e.preventDefault()
		return
