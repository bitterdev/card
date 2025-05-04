<?php /** @noinspection DuplicatedCode */

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Application\Service\UserInterface;
use Concrete\Core\Editor\EditorInterface;
use Concrete\Core\Form\Service\DestinationPicker\DestinationPicker;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\View\View;

/** @var string|null $title */
/** @var string|null $body */
/** @var int|null $fID */
/** @var string|null $buttonLabel */
/** @var int|null $cID */
/** @var int|null $buttonInternalLinkCID */
/** @var int|null $buttonFileLinkID */
/** @var string|null $buttonExternalLink */

$title = $title ?? null;
$body = $body ?? null;
$fID = $fID ?? null;
$buttonLabel = $buttonLabel ?? null;
$buttonLink = null;
$cID = $cID ?? null;
$buttonInternalLinkCID = $buttonInternalLinkCID ?? null;
$buttonFileLinkID = $buttonFileLinkID ?? null;
$buttonExternalLink = $buttonExternalLink ?? null;

$buttonLinkHandle = 'none';
$buttonLinkValue = null;

if (!empty($buttonInternalLinkCID) && $buttonInternalLinkCID > 0) {
    $buttonLinkHandle = 'page';
    $buttonLinkValue = $buttonInternalLinkCID;
} elseif (!empty($buttonFileLinkID) && $buttonFileLinkID > 0) {
    $buttonLinkHandle = 'file';
    $buttonLinkValue = $buttonFileLinkID;
} elseif (!empty($buttonExternalLink) && strlen($buttonExternalLink) > 0) {
    $buttonLinkHandle = 'external_url';
    $buttonLinkValue = $buttonExternalLink;
}

$app = Application::getFacadeApplication();
/** @var UserInterface $userInterface */
/** @noinspection PhpUnhandledExceptionInspection */
$userInterface = $app->make(UserInterface::class);
/** @var Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);
/** @var EditorInterface $editor */
/** @noinspection PhpUnhandledExceptionInspection */
$editor = $app->make(EditorInterface::class);
/** @var FileManager $fileManager */
/** @noinspection PhpUnhandledExceptionInspection */
$fileManager = $app->make(FileManager::class);
/** @var DestinationPicker $destinationPicker */
/** @noinspection PhpUnhandledExceptionInspection */
$destinationPicker = $app->make(DestinationPicker::class);

/** @noinspection PhpUnhandledExceptionInspection */
View::element("dashboard/help_blocktypes", [], "card");

/** @noinspection PhpUnhandledExceptionInspection */
View::element("dashboard/did_you_know", [], "card");
?>

<div class="form-group">
    <?php echo $form->label("fID", t('Header Image')); ?>
    <?php echo $fileManager->image("fID", "fID", t("Please select file..."), $fID); ?>
</div>

<div class="form-group">
    <?php echo $form->label("title", t('Title')); ?>
    <?php echo $form->text("title", $title); ?>
</div>

<div class="form-group">
    <?php echo $form->label("body", t('Body')); ?>
    <?php echo $editor->outputStandardEditor("body", $body); ?>
</div>

<div class="mb-3">
    <?php echo $form->label('buttonLink', t('Button Link')) ?>
    <?php echo $destinationPicker->generate(
        'buttonLink',
        [
            'none',
            'page',
            'file',
            'external_url' => ['maxlength' => 255],
        ],
        $buttonLinkHandle,
        $buttonLinkValue
    )
    ?>

    <div class="help-block">
        <?php echo t('Set to None to omit the button.') ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label("buttonLabel", t('Button Label')); ?>
    <?php echo $form->text("buttonLabel", $buttonLabel); ?>
</div>
