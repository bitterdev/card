<?php /** @noinspection DuplicatedCode */

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Entity\File\File as FileEntity;
use Concrete\Core\File\File;
use Concrete\Core\Entity\File\Version;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Url;

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
$imageUrl = $imageUrl ?? null;
$imageUrlAltText = $imageUrlAltText ?? null;
$buttonLabel = $buttonLabel ?? null;
$buttonLink = null;
$cID = $cID ?? null;
$buttonInternalLinkCID = $buttonInternalLinkCID ?? null;
$buttonFileLinkID = $buttonFileLinkID ?? null;
$buttonExternalLink = $buttonExternalLink ?? null;

if (!empty($buttonInternalLinkCID) && $buttonInternalLinkCID > 0) {
    $buttonLink = (string)Url::to(Page::getByID($buttonInternalLinkCID));
} elseif (!empty($buttonFileLinkID) && $buttonFileLinkID > 0) {
    $f = File::getByID($buttonFileLinkID);

    if ($f instanceof FileEntity) {
        $fv = $f->getApprovedVersion();
        if ($fv instanceof Version) {
            $buttonLink = $fv->getURL();
        }
    }
} elseif (!empty($buttonExternalLink) && strlen($buttonExternalLink) > 0) {
    $buttonLink = $buttonExternalLink;
}

$f = File::getByID($fID);

if ($f instanceof FileEntity) {
    $fv = $f->getApprovedVersion();
    if ($fv instanceof Version) {
        $imageUrl = $fv->getURL();
        $imageUrlAltText = $fv->getTitle();
    }
}
?>

<div class="card">
    <?php if (!empty($imageUrl)) { ?>
        <img class="card-img-top" src="<?php echo $imageUrl; ?>" alt="<?php echo $imageUrlAltText; ?>">
    <?php } ?>

    <div class="card-body">
        <?php if (!empty($title)) { ?>
            <h5 class="card-title">
                <?php echo $title; ?>
            </h5>
        <?php } ?>

        <?php if (!empty($body)) { ?>
            <p class="card-text">
                <?php echo $body ?>
            </p>
        <?php } ?>

        <?php if (!empty($buttonLink) && !empty($buttonLabel)) { ?>
            <a href="<?php echo h($buttonLink); ?>" class="btn btn-primary">
                <?php echo $buttonLabel; ?>
            </a>
        <?php } ?>
    </div>
</div>