DELIMITER = '|<>|'

# Displays an admin section based on the selected target

showSection = (target) ->
	$('.js-show-section').each -> $(@).removeClass('active')
	target.addClass('active')
	if target.hasClass('js-new-post-a')
		$('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeIn()))

	if target.hasClass('js-blog-settings-a')
		$('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeIn()))

	if target.hasClass('js-edit-posts-a')
		$('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeIn()))
	return

# Sets the focus to the class with supplied class

setInputFocus = (targetClass) ->
	$(targetClass).focus()
	initVal = $(targetClass).val()
	$(targetClass).val('')
	$(targetClass).val(initVal)
	return

validateInputs = (targetClass) ->
	invalid = false
	$(targetClass).find('input[type=text], textarea').each -> if $(this).hasClass('required') and $(this).val() is '' then invalid = true

	if invalid is false
		targetClass.submit()
	else
		$('.js-error-message').html('Please complete all inputs').fadeIn()
		setTimeout(
			-> $('.js-error-message').fadeOut(500)
			4000
		)
	return

$ ->
	
	setTimeout(
		-> $('body').removeClass('invisible')
		50
	)

	
	setTimeout(
		-> 
			$('.message').each ->
				if not $(this).hasClass('no-remove') then $('.message').fadeOut(500, -> $('.message').remove())
			return
		4000
	)

	$('textarea').css('overflow', 'hidden').autosize()

	setInputFocus('.js-focus-input')

	$('.js-validate-form').submit (e) ->
		e.preventDefault()
		validateInputs(e.target)
		return

	$('.js-show-section').click (e) ->
		showSection($(e.target))
		e.preventDefault()
		return

	$('.js-tags-input').keydown (e) -> 
		if e.keyCode is 13
			e.preventDefault()

			val = $('.js-tags').val()
			if val isnt ''
				valArray = val.split(DELIMITER)
				valArray.push $(e.target).val()
				val = valArray.join(DELIMITER)
			else
				val = $(e.target).val()
			$('.js-tags').val(val)

			$('.tag-holder').append('<div class="tag-name" data-tag="'+$(e.target).val()+'">'+$(e.target).val()+'<span class="js-tag-remove"> x</span></div>')

			$(e.target).val('')
		return

	$('body').on 'click', '.js-tag-remove', (e) -> 
		# remove
		$(e.target).parent().remove()
		# rebuild the tags
		valArray = []
		$('.tag-name').each (e) -> valArray.push $(this).data('tag')
		$('.js-tags').val(valArray.join(DELIMITER))







